<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;
use DB;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer');
    }

    public function table()
    {
        $customer = Customer::query()
                            ->selectRaw('customers.id, customers.phone,
            customers.acc_name, customers.email, users.name as username')
                            ->join('users', 'users.id', '=', 'customers.assigned_to');

        return DataTables::of($customer)->make(true);
    }

    public function create()
    {
        $customer = collect([
            "id"             => "",
            "acc_name"       => "",
            "phone"          => "",
            "other_phone"    => "",
            "email"          => "",
            "parent_company" => "",
            "acc_no"         => "",
            "website"        => "",
            "fax"            => "",
            "employees"      => "",
            "ownership"      => "",
            "industry"       => "",
            "sales_manager"  => "",
            "assigned_to"    => "",
            "sales_person"   => "",
            "acc_status"     => "",
            "tax_id"         => "",
            "reseller_id"    => "",
            "payment_method" => "",
            "tac"            => "",
            "address"        => "",
            "description"    => "",
        ]);

        return view('customer_form', compact('customer'));
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $data['assigned_to'] = auth()->user()->id;
        Customer::query()->insert($data);

        return ['success' => true];
    }

    public function show($id)
    {
        $customer = Customer::find($id);

        return view('customer_form', compact('customer'));
    }

    public function update(Request $request)
    {
        Customer::query()->where('id', $request->overview['id'])->update($request->overview);

        return ['success' => true];
    }

    public function destroy(Request $request)
    {
        Customer::query()->where('id', $request->id)->delete();

        return ['success' => true];
    }

    public function getList(Request $request)
    {
        return [
            "results" => DB::table('customers')
                           ->selectRaw("id as id, acc_name as text")
                           ->whereRaw("acc_name LIKE '%{$request->term}%'")
                           ->get(),
        ];
    }
}
