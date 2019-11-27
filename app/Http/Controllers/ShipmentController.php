<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Shipment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class ShipmentController extends Controller
{
    public function table()
    {
        $shipment = DB::table('shipments')
            ->selectRaw('shipments.*, customers.name as customer_name, qty.total')
            ->leftJoin(DB::raw(
                '(SELECT shipment_id, SUM(qty_out) total FROM carts group by shipment_id) qty'), 
                function($join)
                {
                    $join->on('qty.shipment_id', '=', 'shipments.id');
                }
            )
            ->leftJoin('customers', 'customers.id', '=', 'shipments.customer_id');

        return DataTables::of($shipment)->make(true);
    }

    public function checked(Request $request)
    {
        Batch::query()->where('id', $request->id)
            ->update([
                'checked_by' => auth()->user()->id
            ]);
        $this->approvedIncrement($request);

        return ['success' => true];
    }

    public function approved(Request $request)
    {
        Batch::query()->where('id', $request->id)
            ->update([
                'approved_by' => auth()->user()->id
            ]);

        $this->approvedIncrement($request);
    
        return ['success' => true];
    }

    public function approvedIncrement($request)
    {
        $batch = Batch::where('id', $request->id)->get()->toArray()[0];
        if($batch["checked_by"]!= '' && $batch["approved_by"]!= '' ) {
            Product::query()->where('id',$batch["product_id"])->increment('quantity', $batch['qty_in']);
        }
    }

    public function items(Request $request)
    {
        return Cart::query()
            ->selectRaw('carts.*, products.name as product_name,
            (SELECT name FROM users WHERE id = carts.checked_by) as checker,
            (SELECT name FROM users WHERE id = carts.guard_by) as guard
            ')
            ->where('carts.shipment_id', $request->id)
            ->leftJoin('products','products.id','carts.product_id')
            ->get()->toArray();
    }
}
