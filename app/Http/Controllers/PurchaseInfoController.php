<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ProductDetail;
use App\PurchaseInfo;
use App\Summary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Yajra\DataTables\DataTables;
use PDF;

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
            vendors.name as vendor_name, purchase_infos.tracking_number, purchase_infos.po_no,
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

    public function store(Request $request)
    {
        $data = $request->input();

        if ($data['overview']['payment_method'] != 'Check') {
            $data['overview']['check_number'] = '';
            $data['overview']['check_writer'] = '';
        }

        $data['overview']['status']      = 'Ordered';
        $data['overview']['created_at']  = Carbon::now()->format('Y-m-d');
        $data['overview']['assigned_to'] = auth()->user()->id;
        $id                              = DB::table('purchase_infos')->insertGetId($data['overview']);

        if (isset($data['products'])) {
            foreach ($data['products'] as $item) {
                unset($item['category']);
                if (count($item) > 2) {
                    $item['purchase_order_id'] = $id;
                    DB::table('product_details')->insert($item);
                }
            }
        }

        $data['summary']['purchase_order_id'] = $id;
        DB::table('summaries')->insert($data['summary']);

        return ['success' => true];
    }

    public function update(Request $request)
    {
        $data = $request->input();
        unset($data['overview']['vendor_name']);
        if ($data['overview']['payment_method'] != 'Check') {
            $data['overview']['check_number'] = '';
            $data['overview']['check_writer'] = '';
        }

        DB::table('purchase_infos')->where('id', $data['overview']['id'])->update($data['overview']);

        DB::table('product_details')->where('purchase_order_id', $data['overview']['id'])->delete();

        if (isset($data['products'])) {
            foreach ($data['products'] as $item) {
                $item['purchase_order_id'] = $data['overview']['id'];
                unset($item['category']);
                unset($item['unit']);
                if (count($item) > 2) {
                    DB::table('product_details')->insert($item);
                }
            }
        }

        DB::table('summaries')->where('purchase_order_id', $data['overview']['id'])->delete();
        $data['summary']['purchase_order_id'] = $data['overview']['id'];
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

    public function updateStatus(Request $request)
    {
        $data          = $request->input();
        $purchase_info = DB::table('purchase_infos')->where('id', $data['id'])->get()[0];

        if ($purchase_info->status != $data['status']) {
            DB::table('purchase_infos')->where('id', $data['id'])
              ->update(['status' => $data['status']]);

            $product_detail = DB::table('product_details')->where('purchase_order_id', $data['id'])->get();
            foreach ($product_detail as $value) {
                if ('Ordered' == $data['status']) {
                    DB::table('supplies')->where('product_id', $value->product_id)->decrement('quantity', $value->qty);
                }
                if ('Received' == $data['status']) {
                    DB::table('supplies')->where('product_id', $value->product_id)->increment('quantity', $value->qty);
                }
            }

            return ['success' => true];
        }

        return ['success' => false];
    }

    public function show($id)
    {
        $data = $this->getOverview($id);
        $purchase_info = $data['purchase_info'];
        $product_details = $data['product_details'];
        $summary = $data['summary'];

        return view('purchase_form', compact('purchase_info', 'product_details', 'summary'));
    }

    public function printable($id)
    {
        $data = $this->getOverview($id);
        $purchase_info = $data['purchase_info'];
        $product_details = $data['product_details'];
        $summary = $data['summary'];
        $sections        = [];
        $cnt             = -1;
        foreach ($product_details as $key => $value) {
            if (count($value) == 1) {
                $sections[] = [
                    $value['category'] => 0,
                ];
                $cnt++;
            } else {
                $total_selling                      = $value['qty'] * $value['selling_price'];
                $total_labor                        = $value['qty'] * $value['labor_cost'];
                $sections[$cnt][$value['category']] += $total_labor + ($total_selling - ($total_selling * ($value['discount_item'] / 100)));
            }
        }

        $hold_section = $sections;
        foreach ($hold_section as $index => $section) {
            foreach ($section as $key => $value) {
                $hold_section[$index] = [$this->converToRoman($index + 1) . '. ' . $key => $value];
            }
        }
        $sections = $hold_section;


        $pdf = PDF::loadView('purchase_printable',
        ['purchase_info'     => $purchase_info,
         'product_details' => $product_details,
         'summary'         => $summary,
         'sections'        => $sections,
        ]);
    
        return $pdf->setPaper('a4')->download('PO_' . $purchase_info["status"] . '-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    public function previewPO($id)
    {
        $data =  $this->getOverview($id);
        $purchase_info = $data['purchase_info'];
        $product_details = $data['product_details'];
        $summary = $data['summary'];
        $sections        = [];
        $cnt             = -1;
        foreach ($product_details as $key => $value) {
            if (count($value) == 1) {
                $sections[] = [
                    $value['category'] => 0,
                ];
                $cnt++;
            } else {
                $total_selling                      = $value['qty'] * $value['selling_price'];
                $total_labor                        = $value['qty'] * $value['labor_cost'];
                $sections[$cnt][$value['category']] += $total_labor + ($total_selling - ($total_selling * ($value['discount_item'] / 100)));
            }
        }

        $hold_section = $sections;
        foreach ($hold_section as $index => $section) {
            foreach ($section as $key => $value) {
                $hold_section[$index] = [$this->converToRoman($index + 1) . '. ' . $key => $value];
            }
        }
        $sections = $hold_section;

        return view('purchase_printable', compact('purchase_info', 'product_details', 'summary', 'sections'));
    }

    public function getOverview($id)
    {
        $purchase_info   = PurchaseInfo::query()
                                       ->selectRaw('purchase_infos.*, IFNULL(vendors.name, \'\') as vendor_name')
                                       ->leftJoin('vendors', 'vendors.id', '=', 'purchase_infos.vendor_id')
                                       ->where('purchase_infos.id', $id)
                                       ->get()[0];
        $product_details = ProductDetail::query()
                                        ->selectRaw('products.category, products.unit, product_details.*')
                                        ->where('purchase_order_id', $id)
                                        ->join('products', 'products.id', 'product_details.product_id')
                                        ->get();
        $category        = '';
        $hold            = [];
        foreach ($product_details->toArray() as $value) {
            if ($value['category'] != $category) {
                $hold[]   = ['category' => $value['category']];
                $category = $value['category'];
            }
            unset($value['manual_id']);
            unset($value['name']);
            unset($value['code']);
            unset($value['manufacturer']);
            unset($value['description']);
            unset($value['batch']);
            unset($value['color']);
            unset($value['size']);
            unset($value['weight']);
            unset($value['assigned_to']);
            unset($value['id']);
            $hold[] = $value;
        }

        $product_details = collect($hold);

        $summary = Summary::query()->where('purchase_order_id', $id)->get()[0];

        return [
            'purchase_info' => $purchase_info,
            'product_details' => $product_details,
            'summary' => $summary
        ];
    }

    public function converToRoman($num)
    {
        $n   = intval($num);
        $res = '';

        //array of roman numbers
        $romanNumber_Array = [
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1,
        ];

        foreach ($romanNumber_Array as $roman => $number) {
            //divide to get  matches
            $matches = intval($n / $number);

            //assign the roman char * $matches
            $res .= str_repeat($roman, $matches);

            //substract from the number
            $n = $n % $number;
        }

        // return the result
        return $res;
    }
}
