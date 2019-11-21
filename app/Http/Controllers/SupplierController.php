<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    public function table()
    {
        return DataTables::of(Supplier::all())->make(true);
    }

    public function getList(Request $request)
    {
        return Supplier::query()
            ->selectRaw('id,name')
            ->where('name', 'LIKE', "%{$request->q}%")
            ->get();
    }
}
