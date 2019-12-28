<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ProductDetail;
use App\PurchaseInfo;
use App\Summary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PurchaseInfoController extends Controller
{
    public function index()
    {
        return view('purchase');
    }

    public function table()
    {
        $purchase_info = PurchaseInfo::query()
                                     ->selectRaw('purchase_infos.id, purchase_infos.subject,
            vendors.name as vendor_name, purchase_infos.tracking_number,
            purchase_infos.requisition_no, users.name, purchase_infos.status')
                                     ->leftJoin('vendors', 'vendors.id', '=', 'purchase_infos.vendor_id')
                                     ->join('users', 'users.id', '=', 'purchase_infos.assigned_to');

        return DataTables::of($purchase_info)->make(true);
    }

    public function create()
    {
        $purchase_info = collect([
            "id"               => "",
            "subject"          => "",
            "vendor_id"        => "",
            "requisition_no"   => "",
            "tracking_number"  => "",
            "contact_name"     => "",
            "phone"            => "",
            "due_date"         => "",
            "fax"              => "",
            "carrier"          => "",
            "deliver_to"       => "",
            "shipping_method"  => "",
            "assigned_to"      => "",
            "status"           => "",
            "date_received"    => "",
            "po_no"            => PurchaseInfo::generate()->newPONo(),
            "payment_method"   => "",
            "billing_address"  => "",
            "check_number"     => "",
            "check_writer"     => "",
            "delivery_address" => "",
            "tac"              => "",
            "description"      => "",
        ]);

        $product_details = collect([]);

        $summary = collect([
            "id"                => "",
            "purchase_order_id" => "",
            "discount"          => "0",
            "shipping"          => "0",
            "sales_tax"         => "0",
        ]);

        return view('purchase_form', compact('purchase_info', 'product_details', 'summary'));
    }

    public function show($id)
    {
        $purchase_info   = PurchaseInfo::query()
                                       ->selectRaw('purchase_infos.*, IFNULL(vendors.name, \'\') as vendor_name')
                                       ->leftJoin('vendors', 'vendors.id', '=', 'purchase_infos.vendor_id')
                                       ->where('purchase_infos.id', $id)
                                       ->get()[0];
        $product_details = ProductDetail::query()->where('purchase_order_id', $id)->get();
        $summary         = Summary::query()->where('purchase_order_id', $id)->get()[0];

        return view('purchase_form', compact('purchase_info', 'product_details', 'summary'));
    }

    public function update(Request $request)
    {
        $data = $request->input();
        unset($data['overview']['vendor_name']);
        if ($data['overview']['payment_method'] != 'Check') {
            $data['overview']['check_number'] = '';
            $data['overview']['check_writer'] = '';
        }

        DB::table('purchase_infos')->where('id', $data['overview']['id'])
          ->update($data['overview']);

        DB::table('product_details')->where('purchase_order_id', $data['overview']['id'])->delete();

        if (isset($data['products'])) {
            foreach ($data['products'] as $item) {
                $item['purchase_order_id'] = $data['overview']['id'];
                DB::table('product_details')->insert($item);
            }
        }

        DB::table('summaries')->where('purchase_order_id', $data['overview']['id'])->delete();
        $data['summary']['purchase_order_id'] = $data['overview']['id'];
        DB::table('summaries')->insert($data['summary']);

        return ['success' => true];
    }

    public function store(Request $request)
    {
        $data = $request->input();

        if ($data['overview']['payment_method'] != 'Check') {
            $data['overview']['check_number'] = '';
            $data['overview']['check_writer'] = '';
        }

        $data['overview']['assigned_to'] = auth()->user()->id;
        $id                              = DB::table('purchase_infos')->insertGetId($data['overview']);

        if (isset($data['products'])) {
            foreach ($data['products'] as $item) {
                $item['purchase_order_id'] = $id;
                DB::table('product_details')->insert($item);
            }
        }

        $data['summary']['purchase_order_id'] = $id;
        DB::table('summaries')->insert($data['summary']);

        return ['success' => true];
    }

    public function destroy(Request $request)
    {
        DB::table('product_details')->where('purchase_info_id', $request->id)->delete();
        DB::table('purchase_infos')->where('id', $request->id)->delete();
        DB::table('summaries')->where('purchase_order_id', $request->id)->delete();

        return ['success' => true];
    }
}
