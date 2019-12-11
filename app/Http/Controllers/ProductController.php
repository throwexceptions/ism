<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('product');
    }    
    
    public function table()
    {
        $products = Product::query()
            ->selectRaw('products.*, users.name as username')
            ->join('users', 'users.id','=','products.assigned_to');
        
        return DataTables::of($products)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $product = collect([
            "assigned_to" => "",
            "category" => "",
            "code" => "",
            "color" => "",
            "created_at" => "",
            "discontinued" => "",
            "id" => "",
            "manufacturer" => "",
            "name" => "",
            "size" => "",
            "sku" => "",
            "updated_at" => "",
            "username" => "",
            "weight" => "",
        ]);

        return view('product_form', compact('product'));
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
        $product = Product::find($id);

        return view('product_form', compact('product'));
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
