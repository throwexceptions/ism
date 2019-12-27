<?php

namespace App\Http\Controllers;

use App\OrderForm;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderFormController extends Controller
{
    public function index()
    {
        return view('orderform');
    }

    public function table()
    {
        $purchase_info = OrderForm::query()
                                  ->join('users', 'users.id', '=', 'order_forms.prepared_by');

        return DataTables::of($purchase_info)->make(true);
    }

    public function create()
    {
        $orderform = collect([
            "customer_id" => "",
            "acct_exec" => "",
            "no" => "",
            "so_no" => "",
            "po_no" => "",
            "prepared_by" => "",
            "stock_card_in" => "",
            "plate_no" => "",
            "driver" => "",
        ]);

        $product_details = collect([]);

        return view('orderform_form', compact('orderform', 'product_details'));
    }
}
