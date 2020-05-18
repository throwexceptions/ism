<?php

namespace App\Http\Controllers;

use App\AuditLog;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AuditLogController extends Controller
{
    public function index()
    {
        return view('audit');
    }

    public function table()
    {
        $audit = AuditLog::all();

        return DataTables::of($audit)->make(true);
    }
}
