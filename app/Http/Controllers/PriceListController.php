<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PriceListController extends Controller
{
    public function index()
    {
        return view('pricelist');
    }

    public function upload(Request $request)
    {
        //$request->logo->storeAs('logo', 'logo.jpg');
        dd($request->);
        return redirect('/pricelist');
    }
}
