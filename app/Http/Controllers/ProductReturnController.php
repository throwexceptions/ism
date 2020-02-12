<?php

namespace App\Http\Controllers;

use App\ProductReturn;
use Illuminate\Http\Request;
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
                             ->selectRaw('product_returns.*, users.name as username, customers.name as customer_name')
                             ->leftJoin('customers', 'customers.id', '=', 'product_returns.customer_id')
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

        $summary = collect([
            "id"                => "",
            "purchase_order_id" => "",
            "discount"          => "0",
            "shipping"          => "0",
            "sales_tax"         => "0",
            "sales_actual"      => "0",
            "grand_total"       => "0",
        ]);


        return view('return_form', compact('product_return', 'product_details', 'summary'));
    }
}
