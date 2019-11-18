<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function table()
    {
        return DataTables::of(Customer::all())->make(true);
    }

    public function getList(Request $request)
    {
        return Customer::query()
            ->selectRaw('id,name')
            ->where('name', 'LIKE', "%{$request->q}%")
            ->get();
    }
}
