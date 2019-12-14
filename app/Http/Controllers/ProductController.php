<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('product');
    }

    public function table()
    {
        $products = Product::query()
                           ->selectRaw('products.*, users.name as username')
                           ->join('users', 'users.id', '=', 'products.assigned_to');

        return DataTables::of($products)->make(true);
    }

    public function create()
    {
        $product = collect([
            "assigned_to"  => "",
            "category"     => "",
            "code"         => "",
            "color"        => "",
            "created_at"   => "",
            "discontinued" => "",
            "id"           => "",
            "manufacturer" => "",
            "name"         => "",
            "size"         => "",
            "sku"          => "",
            "updated_at"   => "",
            "username"     => "",
            "weight"       => "",
        ]);

        return view('product_form', compact('product'));
    }

    public function getList(Request $request)
    {
        return [
            "results" => DB::table('products')
                           ->selectRaw("id as id, name || ' - ' || id as text")
                           ->whereRaw("name LIKE '%{$request->term}%'")
                           ->get(),
        ];
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('product_form', compact('product'));
    }

    public function edit($id)
    {
        return view('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
