<?php

namespace App\Http\Controllers;

use App\ProductDetail;
use App\ProductReturn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductReturnController extends Controller
{
    public function index()
    {
        return view('return');
    }

    public function table()
    {
        $product_return = ProductReturn::query()
                             ->selectRaw('product_returns.*, users.name as username, customers.name as customer_name,
                             sales_orders.so_no')
                             ->leftJoin('customers', 'customers.id', '=', 'product_returns.customer_id')
                             ->leftJoin('sales_orders', 'sales_orders.id', '=', 'product_returns.sales_order_id')
                             ->join('users', 'users.id', '=', 'product_returns.assigned_to');

        return DataTables::of($product_return)->make(true);
    }

    public function create()
    {
        $product_return = collect([
            "id"               => "",
            "customer_id"      => "",
            "sales_order_id"   => "",
            "pr_no"            => ProductReturn::generate()->newPRNo(),
            "return_type"      => "",
            "contact_person"   => "",
            "reason"           => "",
            "remarks"          => "",
            "assigned_to"      => "",
            "created_at"       => "",
            "updated_at"       => "",
        ]);

        $product_details = collect([]);


        return view('return_form', compact('product_return', 'product_details'));
    }

    public function store(Request $request)
    {
        $data = $request->input();

        $data['overview']['created_at']  = Carbon::now()->format('Y-m-d');
        $data['overview']['assigned_to'] = auth()->user()->id;
        $id                              = DB::table('product_returns')->insertGetId($data['overview']);

        if (isset($data['products'])) {
            foreach ($data['products'] as $item) {
                unset($item['category']);
                unset($item['quantity']);
                unset($item['unit']);
                if (count($item) > 2) {
                    $item['product_return_id'] = $id;
                    DB::table('product_details')->insert($item);
                }
            }

            foreach ($data['products'] as $value) {
                DB::table('supplies')->where('product_id', $value['product_id'])->increment('quantity', $value['qty']);
            }
        }

        return ['success' => true];
    }

    public function show($id)
    {
        $product_return = ProductReturn::query()
                             ->selectRaw('product_returns.*, users.name as username, customers.name as customer_name,
                             sales_orders.so_no')
                             ->leftJoin('customers', 'customers.id', '=', 'product_returns.customer_id')
                             ->leftJoin('sales_orders', 'sales_orders.id', '=', 'product_returns.sales_order_id')
                             ->join('users', 'users.id', '=', 'product_returns.assigned_to')
                             ->get()[0];
        
        $product_details = ProductDetail::query()
                            ->selectRaw('products.category, products.unit, product_details.*')
                            ->where('product_return_id', $id)
                            ->join('products', 'products.id', 'product_details.product_id')
                            ->get();

        $category        = '';
        $hold            = [];
        foreach ($product_details->toArray() as $value) {
            if ($value['category'] != $category) {
                $hold[]   = ['category' => $value['category']];
                $category = $value['category'];
            }
            unset($value['manual_id']);
            unset($value['name']);
            unset($value['code']);
            unset($value['manufacturer']);
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

        return view('return_form', compact('product_return', 'product_details'));
    }

    public function destroy(Request $request)
    {
        $data = $request->input();

        $product_details = ProductDetail::query()
                            ->selectRaw('products.category, products.unit, product_details.*')
                            ->where('product_return_id', $data['id'])
                            ->join('products', 'products.id', 'product_details.product_id')
                            ->get()->toArray();

        foreach($product_details as $item) {
            DB::table('supplies')->where('product_id', $item['product_id'])->decrement('quantity', $item['qty']);
        }
        ProductReturn::truncate('id', $data['id']);
        ProductDetail::truncate('product_return_id', $data['id']);

        return ['success' => true];
    }
}
