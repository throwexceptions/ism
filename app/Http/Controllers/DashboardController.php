<?php

namespace App\Http\Controllers;

use App\PurchaseInfo;
use App\SalesOrder;
use App\Supply;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function inStock()
    {
        $supply = Supply::query()
                        ->selectRaw('supplies.*, products.name as product_name')
                        ->join('products', 'products.id', '=', 'supplies.product_id')
                        ->where('supplies.quantity', '<>', 0);

        return DataTables::of($supply)->make(true);
    }

    public function outOfStock()
    {
        $supply = Supply::query()
                        ->selectRaw('supplies.*, products.name as product_name')
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
}
