<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('customer');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $customer = collect(array(
            "id" => "",
            "acc_name" => "",
            "phone" => "",
            "other_phone" => "",
            "email" => "",
            "parent_comapny" => "",
            "acc_no" => "",
            "website" => "",
            "fax" => "",
            "employees" => "",
            "ownership" => "",
            "industry" => "",
            "sales_manager" => "",
            "assigned_to" => "",
            "sales_person" => "",
            "acc_status" => "",
            "tax_id" => "",
            "reseller_id" => "",
            "payment_method" => "",
            "tac" => "",
            "address" => "",
            "description" => "",
        ));

        return view('customer_form', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        return view('customer_form', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('inventory::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function table()
    {
        $customer = Customer::query()
            ->selectRaw('customers.id, customers.phone,
            customers.acc_name, customers.email, users.name as username')
            ->join('users', 'users.id','=','customers.assigned_to');
        
        return DataTables::of($customer)->make(true);
    }
}
