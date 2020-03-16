<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceListUploadRequest;
use App\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PriceListController extends Controller
{
    public function index()
    {
        return view('pricelist');
    }

    public function table()
    {
        $price_list = DB::table('price_lists');

        return DataTables::of($price_list)->make(true);
    }

    public function upload(PriceListUploadRequest $request)
    {
        $original_name = $request->file('excel_file')->getClientOriginalName();
        $path          = $request->file('excel_file')->storeAs('pricelist', $original_name);

        PriceList::create([
            "subject"     => $request->subject,
            "filename"    => $original_name,
            "path"        => $path,
            "assigned_to" => auth()->user()->name,
        ]);

        return redirect('/pricelist');
    }

    public function download($id)
    {
        $path = PriceList::query()
                         ->where('id', $id)
                         ->pluck('path')[0];

        return Storage::download($path);
    }

    public function destroy(Request $request)
    {
        Storage::delete($request->path);
        PriceList::query()
                 ->where('id', $request->id)
                 ->delete();

        return ["success" => true];
    }
}
