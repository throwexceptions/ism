<?php

namespace App\Http\Controllers;

use App\ProductDetail;
use App\SalesOrder;
use App\Summary;
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
            "status"         => "",
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
                             ->selectRaw('sales_orders.*, users.name as username, customers.acc_name as customer_name')
                             ->leftJoin('customers', 'customers.id', '=', 'sales_orders.customer_id')
                             ->join('users', 'users.id', '=', 'sales_orders.assigned_to');

        return DataTables::of($vendors)->make(true);
    }

    public function show($id)
    {
        $sales_order     = SalesOrder::query()->selectRaw('sales_orders.*, IFNULL(customers.acc_name, \'\') as customer_name')
                                     ->leftJoin('customers', 'customers.id', '=', 'sales_orders.customer_id')
                                     ->where('sales_orders.id', $id)->get()[0];
        $product_details = ProductDetail::query()->where('sales_order_id', $id)->get();
        $summary         = Summary::query()->where('sales_order_id', $id)->get()[0];

        return view('sales_form', compact('sales_order', 'product_details', 'summary'));
    }

    public function store(Request $request)
    {
        $data = $request->input();

        $data['overview']['assigned_to'] = auth()->user()->id;

        $id = DB::table('sales_orders')->insertGetId($data['overview']);
        if (isset($data['products'])) {
            foreach ($data['products'] as $item) {
                $item['sales_order_id'] = $id;
                DB::table('product_details')->insert($item);
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
                DB::table('product_details')->insert($item);
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
        DB::table('product_details')->where('purchase_info_id', $request->id)->delete();
        DB::table('salesorders')->where('id', $request->id)->delete();
        DB::table('summaries')->where('sales_order_id', $request->id)->delete();

        return ['success' => true];
    }
}
