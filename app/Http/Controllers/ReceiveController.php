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
            ->selectRaw('batches.*, products.name, suppliers.name as supplier_name, 
            containers.container_no, containers.date_arrival, containers.remarks, users.name as user_name')
            ->leftJoin('products', 'products.id', '=', 'batches.product_id')
            ->leftJoin('containers', 'containers.id', '=', 'batches.container_id')
            ->leftJoin('suppliers', 'suppliers.id', '=', 'containers.supplier_id')
            ->leftJoin('users', 'users.id', '=', 'batches.checked_by');

        return DataTables::of($batch)->make(true);
    }
}
