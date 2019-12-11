<?php

namespace App\Http\Controllers;

use App\Supply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('supply');
    }

    public function table()
    {
        $vendors = Supply::query()
            ->selectRaw('supplies.*, users.name as username, products.name as product_name, 
            (SELECT COUNT(id) FROM product_details WHERE purchase_order_id IS NOT NULL and product_id=supplies.product_id) as po_count,
            (SELECT COUNT(id) FROM product_details WHERE sales_order_id IS NOT NULL and product_id=supplies.product_id) as so_count')
            ->join('products', 'products.id','=','supplies.product_id')
            ->join('users', 'users.id','=','supplies.assigned_to');
        
        return DataTables::of($vendors)->make(true);
    }    

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $supply = collect(array(
            "product_name" => "",
            "product_id" => "",
            "unit_cost" => "",
        ));

        return view('supply_form', compact('supply'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $supply = Supply::query()
            ->selectRaw('supplies.*, products.name as product_name')
            ->join('products', 'products.id','=','supplies.product_id')
            ->where('supplies.id', $id)
            ->get()[0];

        return view('supply_form', compact('supply'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
