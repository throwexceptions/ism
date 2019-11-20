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
}
