<?php

namespace App\Http\Controllers;

use App\Supply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('supply');
    }

    public function table()
    {
        Supply::recalibrate();
        $supplies = Supply::query()
                         ->selectRaw('supplies.*, users.name as username,
                         products.name as product_name, products.manual_id,
                         products.selling_price,
                         ifnull(po_sum.total, 0) as po_count,
                         ifnull(so_sum.total, 0) as so_count')
                         ->join('products', 'products.id', '=', 'supplies.product_id')
                         ->join('users', 'users.id', '=', 'supplies.assigned_to')
                         ->leftJoin(
                             DB::raw(
                                 '(SELECT COUNT(id) as total,
                                 product_id
                                 FROM product_details
                                 WHERE sales_order_id IS NULL
                                 and deleted_at IS NULL group by product_id) as po_sum'),
                             'po_sum.product_id', '=', 'supplies.product_id'
                         )
                         ->leftJoin(
                             DB::raw(
                                 '(SELECT COUNT(id) as total,
                                 product_id
                                 FROM product_details
                                 WHERE purchase_order_id IS NULL
                                 and deleted_at IS NULL group by product_id) as so_sum'),
                             'so_sum.product_id', '=', 'supplies.product_id'
                         );

        return DataTables::of($supplies)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $supply = collect([
            "product_name" => "",
            "product_id"   => "",
            "unit_cost"    => "",
        ]);

        return view('supply_form', compact('supply'));
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $supply = Supply::query()
                        ->selectRaw('supplies.*, products.name as product_name')
                        ->join('products', 'products.id', '=', 'supplies.product_id')
                        ->where('supplies.id', $id)
                        ->get()[0];

        return view('supply_form', compact('supply'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return view('edit');
    }

    public function getPOLinks(Request $request)
    {
        $links = DB::table('product_details')
                   ->selectRaw('DISTINCT purchase_order_id as link,
            purchase_infos.po_no  as number')
                   ->join('purchase_infos', 'purchase_infos.id', 'purchase_order_id')
                   ->where('product_id', $request->product_id)
                   ->where('purchase_order_id', '<>', null)
                   ->get();

        return $links;
    }

    public function getSOLinks(Request $request)
    {
        $links = DB::table('product_details')
                   ->selectRaw('DISTINCT sales_order_id as link,
            sales_orders.so_no as number')
                   ->join('sales_orders', 'sales_orders.id', 'sales_order_id')
                   ->where('product_id', $request->product_id)
                   ->where('sales_order_id', '<>', null)
                   ->get();

        return $links;
    }

    public function updateQuantity(Request $request)
    {
        Supply::query()
              ->where('id', $request->id)
              ->update(['quantity' => $request->quantity]);
    }
}
