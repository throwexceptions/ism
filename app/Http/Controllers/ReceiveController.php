<?php

namespace App\Http\Controllers;

use App\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReceiveController extends Controller
{
    public function table()
    {
        $batch = DB::table('batches')
            ->selectRaw('batches.*, products.name, customers.name as customer_name')
            ->leftJoin('products', 'products.id', '=', 'batches.product_id')
            ->leftJoin('customers', 'customers.id', '=', 'batches.customer_id');

        return DataTables::of($batch)->make(true);
    }
}
