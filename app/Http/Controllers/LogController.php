<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class LogController extends Controller
{
    public function table()
    {
        return DataTables::of(DB::table('logs'))->make(true);
    }
}
