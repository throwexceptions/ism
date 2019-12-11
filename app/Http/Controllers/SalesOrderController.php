<?php

namespace App\Http\Controllers;

use App\ProductDetail;
use App\SalesOrder;
use App\Summary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

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
                             ->join('customers', 'customers.id', '=', 'sales_orders.customer_id')
                             ->join('users', 'users.id', '=', 'sales_orders.assigned_to');

        return DataTables::of($vendors)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return array
     */
    public function store(Request $request)
    {
        return ['success' => true];
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sales_order = SalesOrder::find($id);
        $product_details = ProductDetail::query()->where('sales_order_id', $id)->get();
        $summary = Summary::query()->where('sales_order_id', $id)->get()[0];

        return view('sales_form', compact('sales_order','product_details','summary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return view('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
