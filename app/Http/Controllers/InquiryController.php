<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inquiry;
use Yajra\DataTables\DataTables;

class InquiryController extends Controller
{
    public function index()
    {
        return view('admin.inquiry');
    }

    public function table()
    {
        return DataTables::of(Inquiry::all())->make(true);
    }

    public function destory(Request $request)
    {
        Inquiry::destroy($request->id);

        return ['success' => true];
    }
}
