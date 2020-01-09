<?php

namespace App\Http\Controllers;

use App\ProductDetail;
use App\SalesOrder;
use App\Summary;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;
use DB;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('sales');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $sales_order = collect([
            "id"             => "",
            "subject"        => "",
            "customer_id"    => "",
            "owner"          => "",
            "so_no"          => SalesOrder::generate()->newSONo(),
            "agent"          => "",
            "assigned_to"    => "",
            "fax"    => "",
            "status"         => "Quote",
            "address"        => "",
            "due_date"       => "",
            "payment_method" => "",
            "account_name"   => "",
            "account_no"     => "",
            "tac"            => "",
        ]);

        $product_details = collect([]);

        $summary = collect([
            "id"             => "",
            "sales_order_id" => "",
            "discount"       => "0",
            "shipping"       => "0",
            "sales_tax"      => "0",
        ]);

        return view('sales_form', compact('sales_order', 'product_details', 'summary'));
    }

    public function table()
    {
        $vendors = SalesOrder::query()
                             ->selectRaw('sales_orders.*, users.name as username, customers.name as customer_name')
                             ->leftJoin('customers', 'customers.id', '=', 'sales_orders.customer_id')
                             ->join('users', 'users.id', '=', 'sales_orders.assigned_to');

        return DataTables::of($vendors)->make(true);
    }

    public function show($id)
    {
        $sales_order     = SalesOrder::query()
                                     ->selectRaw('sales_orders.*, IFNULL(customers.name, \'\') as customer_name')
                                     ->leftJoin('customers', 'customers.id', '=', 'sales_orders.customer_id')
                                     ->where('sales_orders.id', $id)
                                     ->get()[0];
        $product_details = ProductDetail::query()
                                        ->selectRaw('products.category, product_details.*')
                                        ->where('sales_order_id', $id)
                                        ->join('products', 'products.id', 'product_details.product_id')
                                        ->get();
        $category = '';
        $hold     = [];
        foreach ($product_details->toArray() as $value) {
            if ($value['category'] != $category) {
                $hold[]   = ['category' => $value['category']];
                $category = $value['category'];
            }
            unset($value['manual_id']);
            unset($value['name']);
            unset($value['code']);
            unset($value['manufacturer']);
            unset($value['unit']);
            unset($value['description']);
            unset($value['batch']);
            unset($value['color']);
            unset($value['size']);
            unset($value['weight']);
            unset($value['assigned_to']);
            unset($value['id']);
            $hold[] = $value;
        }
        $product_details = collect($hold);
        $summary         = Summary::query()->where('sales_order_id', $id)->get()[0];

        return view('sales_form', compact('sales_order', 'product_details', 'summary'));
    }

    public function store(Request $request)
    {
        $data = $request->input();

        $data['overview']['assigned_to'] = auth()->user()->id;
        $data['overview']['created_at']  = Carbon::now()->format('Y-m-d');

        $id = DB::table('sales_orders')->insertGetId($data['overview']);
        if (isset($data['products'])) {
            foreach ($data['products'] as $item) {
                unset($item['category']);
                if (count($item) > 2) {
                    $item['sales_order_id'] = $id;
                    DB::table('product_details')->insert($item);
                }
            }
        }

        $data['summary']['sales_order_id'] = $id;
        DB::table('summaries')->insert($data['summary']);

        return ['success' => true];
    }

    public function update(Request $request)
    {
        $data = $request->input();
        unset($data['overview']['customer_name']);
        DB::table('sales_orders')->where('id', $data['overview']['id'])
          ->update($data['overview']);

        // Insert To Product
        if (isset($data['products'])) {
            DB::table('product_details')->where('sales_order_id', $data['overview']['id'])->delete();
            foreach ($data['products'] as $item) {
                $item['sales_order_id'] = $data['overview']['id'];
                unset($item['category']);
                if (count($item) > 2) {
                    DB::table('product_details')->insert($item);
                }
            }
        }

        // Insert to Summary
        DB::table('summaries')->where('sales_order_id', $data['overview']['id'])->delete();
        $data['summary']['sales_order_id'] = $data['overview']['id'];
        DB::table('summaries')->insert($data['summary']);

        return ['success' => true];
    }

    public function destroy(Request $request)
    {
        DB::table('product_details')->where('sales_order_id', $request->id)->delete();
        DB::table('sales_orders')->where('id', $request->id)->delete();
        DB::table('summaries')->where('sales_order_id', $request->id)->delete();

        return ['success' => true];
    }

    public function updateStatus(Request $request)
    {
        $data          = $request->input();
        $purchase_info = DB::table('sales_orders')->where('id', $data['id'])->get()[0];

        if ($purchase_info->status != $data['status']) {
            DB::table('sales_orders')->where('id', $data['id'])
              ->update(['status' => $data['status']]);

            $product_detail = DB::table('product_details')->where('sales_order_id', $data['id'])->get();
            foreach ($product_detail as $value) {
                if ('Shipped' == $data['status']) {
                    DB::table('supplies')->where('product_id', $value->product_id)->decrement('quantity', $value->qty);
                }
                if ('Returned' == $data['status']) {
                    DB::table('supplies')->where('product_id', $value->product_id)->increment('quantity', $value->qty);
                }
            }

            return ['success' => true];
        }

        return ['success' => false];
    }

    public function printable($id)
    {
        $sales_order     = SalesOrder::query()
                                     ->selectRaw('sales_orders.*, IFNULL(customers.name, \'\') as customer_name')
                                     ->leftJoin('customers', 'customers.id', '=', 'sales_orders.customer_id')
                                     ->where('sales_orders.id', $id)
                                     ->get()[0];
        $product_details = ProductDetail::query()
                                        ->selectRaw('products.category, product_details.*')
                                        ->where('sales_order_id', $id)
                                        ->join('products', 'products.id', 'product_details.product_id')
                                        ->get();
        $category = '';
        $hold     = [];
        foreach ($product_details->toArray() as $value) {
            if ($value['category'] != $category) {
                $hold[]   = ['category' => $value['category']];
                $category = $value['category'];
            }
            unset($value['manual_id']);
            unset($value['name']);
            unset($value['code']);
            unset($value['manufacturer']);
            unset($value['unit']);
            unset($value['description']);
            unset($value['batch']);
            unset($value['color']);
            unset($value['size']);
            unset($value['weight']);
            unset($value['assigned_to']);
            unset($value['id']);
            $hold[] = $value;
        }
        $product_details = collect($hold);
        $summary         = Summary::query()->where('sales_order_id', $id)->get()[0];

        $pdf = PDF::loadView('sales_printable',
            ['sales_order' => $sales_order, 'product_details' => $product_details, 'summary' => $summary]);

        return $pdf->download('quote.pdf');
    }

    public function previewSO($id)
    {

        $sales_order     = SalesOrder::query()
                                     ->selectRaw('sales_orders.*, IFNULL(customers.name, \'\') as customer_name')
                                     ->leftJoin('customers', 'customers.id', '=', 'sales_orders.customer_id')
                                     ->where('sales_orders.id', $id)
                                     ->get()[0];
        $product_details = ProductDetail::query()
                                        ->selectRaw('products.category, product_details.*')
                                        ->where('sales_order_id', $id)
                                        ->join('products', 'products.id', 'product_details.product_id')
                                        ->get();

        $category = '';
        $hold     = [];
        foreach ($product_details->toArray() as $value) {
            if ($value['category'] != $category) {
                $hold[]   = ['category' => $value['category']];
                $category = $value['category'];
            }
            unset($value['manual_id']);
            unset($value['name']);
            unset($value['code']);
            unset($value['manufacturer']);
            unset($value['unit']);
            unset($value['description']);
            unset($value['batch']);
            unset($value['color']);
            unset($value['size']);
            unset($value['weight']);
            unset($value['assigned_to']);
            unset($value['id']);
            $hold[] = $value;
        }
        $product_details = collect($hold);
        $summary         = Summary::query()->where('sales_order_id', $id)->get()[0];

        return view('sales_printable', compact('sales_order', 'product_details', 'summary'));
    }
}
