<?php

namespace App\Http\Controllers;

use App\PurchaseInfo;
use App\SalesOrder;
use App\Supply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $supply = Supply::query()
                        ->selectRaw('(supplies.quantity * products.selling_price) total')
                        ->join('products', 'products.id', '=', 'supplies.product_id')
                        ->where('supplies.quantity', '<>', 0);

        $assets = 0;
        foreach($supply->get()->toArray() as $value) {
            $assets += $value['total'];
        }


        $supply = Supply::query()
                        ->selectRaw('supplies.quantity total')
                        ->join('products', 'products.id', '=', 'supplies.product_id')
                        ->where('supplies.quantity', '<>', 0);

        $stocks = 0;
        foreach($supply->get()->toArray() as $value) {
            $stocks += $value['total'];
        }

        $po_count = PurchaseInfo::query()->count();

        $so_count = SalesOrder::query()->count();

        return view('dashboard',  compact('assets', 'stocks', 'po_count', 'so_count'));
    }

    public function inStock()
    {
        $supply = Supply::query()
                        ->selectRaw('supplies.*, products.name as product_name, products.manual_id')
                        ->join('products', 'products.id', '=', 'supplies.product_id')
                        ->where('supplies.quantity', '<>', 0);

        return DataTables::of($supply)->make(true);
    }

    public function outOfStock()
    {
        $supply = Supply::query()
                        ->selectRaw('supplies.*, products.name as product_name, products.manual_id')
                        ->join('products', 'products.id', '=', 'supplies.product_id')
                        ->where('supplies.quantity', '=', 0);

        return DataTables::of($supply)->make(true);
    }

    public function orderedPO()
    {
        $po = PurchaseInfo::query()->where('status', 'Ordered');

        return DataTables::of($po)->make(true);
    }

    public function quoteSO()
    {
        $so = SalesOrder::query()->where('status', 'Quote');

        return DataTables::of($so)->make(true);
    }

    public function returnedSO()
    {
        $so = SalesOrder::query()->where('status', 'Returned');

        return DataTables::of($so)->make(true);
    }

    public function totalPO(Request $request)
    {
        $data = $request->input();
        $result = DB::table('purchase_infos')
            ->selectRaw('SUM(summaries.grand_total) as total')
            ->leftJoin('summaries', 'summaries.purchase_order_id', '=', 'purchase_infos.id');
        
        if($data['start'] != '') {
            $result->whereBetween('purchase_infos.created_at', [$data['start'], $data['end']]);
        }

        return $result->get();
    }

    public function totalSO(Request $request)
    {
        $data = $request->input();
        $result = DB::table('sales_orders')
            ->selectRaw('SUM(summaries.grand_total) as total')
            ->leftJoin('summaries', 'summaries.sales_order_id', '=', 'sales_orders.id');
        
        if($data['start'] != '') {
            $result->whereBetween('sales_orders.created_at', [$data['start'], $data['end']]);
        }

        return $result->get();
    }
}
