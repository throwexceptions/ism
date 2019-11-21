<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class ReceivableController extends Controller
{
    
    public function table()
    {
        $receivables = DB::table('receivables')
            ->selectRaw('receivables.*, suppliers.name as supplier_name, qty.total')
            ->leftJoin(DB::raw(
                '(SELECT receivable_id, SUM(qty_in) total FROM batches group by receivable_id) qty'), 
                function($join)
                {
                    $join->on('qty.receivable_id', '=', 'receivables.id');
                }
            )
            ->leftJoin('suppliers', 'suppliers.id', '=', 'receivables.supplier_id');

        return DataTables::of($receivables)->make(true);
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

    public function batches(Request $request)
    {
        return Batch::query()
            ->selectRaw('batches.*, products.name as product_name,
            (SELECT name FROM users WHERE id = batches.checked_by) as checker,
            (SELECT name FROM users WHERE id = batches.approved_by) as approver
            ')
            ->where('batches.receivable_id', $request->id)
            ->leftJoin('products','products.id','batches.product_id')
            ->get()->toArray();
    }
}
