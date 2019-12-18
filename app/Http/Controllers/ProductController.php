<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
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
            "id"           => "",
            "assigned_to"  => "",
            "category"     => "",
            "code"         => "",
            "color"        => "",
            "created_at"   => "",
            "discontinued" => "",
            "manufacturer" => "",
            "name"         => "",
            "size"         => "",
            "sku"          => "",
            "updated_at"   => "",
            "weight"       => "",
        ]);

        $gallery = collect([]);

        return view('product_form', compact('product', 'gallery'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $gallery = Gallery::query()->where('product_id', $id)->get();

        return view('product_form', compact('product', 'gallery'));
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
        $data                = $request->input();
        $data['assigned_to'] = auth()->user()->id;
        $id                  = Product::query()->insertGetId($data);

        return ['success' => true, 'id' => $id];
    }

    public function update(Request $request)
    {
        Product::query()->where('id', $request->id)->update($request->input());

        return ['success' => true];
    }

    public function imageUpload(Request $request)
    {
        if (count($request->file()) > 0) {
            if (Gallery::query()->where('product_id', $request->id)->count()) {
                $gallery = Gallery::query()->where('product_id', $request->id)->get()[0];
                Storage::delete($gallery->path);
                Gallery::query()->where('product_id', $request->id)->delete();
            }

            $path = $request->image->store('images');

            $gallery             = new Gallery();
            $gallery->product_id = $request->id;
            $gallery->name       = $path;
            $gallery->path       = $path;
            $gallery->extension  = $request->image->extension();
            $gallery->size       = $request->image->getSize();
            $gallery->created_by = auth()->user()->id;
            $gallery->save();
        }

        return ['success' => true];
    }

    public function destroy(Request $request)
    {
        Product::query()->where('id', $request->id)->delete();

        return ['success' => true];
    }
}
