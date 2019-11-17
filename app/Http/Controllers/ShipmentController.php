<?php

namespace App\Http\Controllers;

use App\Shipment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class ShipmentController extends Controller
{
    public function table()
    {
        $shipment = DB::table('shipments')
            ->selectRaw('shipments.*, batches.batch_no')
            ->leftJoin('batches','batches.id','=','shipments.batch_id');

        return DataTables::of($shipment)->make(true);
    }
}
