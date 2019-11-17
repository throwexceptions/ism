<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function table()
    {
        $product = DB::table('products')
                     ->selectRaw('products.*, galleries.path')
                     ->leftJoin('galleries', 'galleries.product_id', '=', 'products.id');

        return DataTables::of($product)->make(true);
    }

    public function store(Request $request)
    {
        $product            = new Product();
        $product->name      = $request->name;
        $product->size      = $request->size;
        $product->thickness = $request->thickness;
        $product->pack_qty  = $request->pack_qty;
        $product->type      = $request->type;
        $product->save();

        if ($request->file('file')) {
            $path                = $request->file('file')->store('products');
            $gallery             = new Gallery();
            $gallery->product_id = $product->id;
            $gallery->name       = $request->file('file')->getClientOriginalName();
            $gallery->ext        = $request->file('file')->getExtension();
            $gallery->path       = $path;
            $gallery->save();
        }

        return ['success' => true];
    }

    public function update(Request $request)
    {
        $product            = Product::find($request->id);
        $product->name      = $request->name;
        $product->size      = $request->size;
        $product->thickness = $request->thickness;
        $product->pack_qty  = $request->pack_qty;
        $product->type      = $request->type;
        $product->save();

        if ($request->file('file')) {
            $gallery =  Gallery::query()->where('product_id', $request->id)->get();
            if(isset($gallery[0])) {
                Storage::delete($gallery[0]->path);
                Gallery::destroy($gallery[0]->id);
            }

            $path                = $request->file('file')->store('products');
            $gallery             = new Gallery();
            $gallery->product_id = $product->id;
            $gallery->name       = $request->file('file')->getClientOriginalName();
            $gallery->ext        = $request->file('file')->getExtension();
            $gallery->path       = $path;
            $gallery->save();
        }

        return ['success' => true];
    }
}
