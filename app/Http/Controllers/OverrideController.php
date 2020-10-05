<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\DbDumper\Databases\MySql;
use Symfony\Component\Process\Process;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class OverrideController extends Controller
{
    public function index()
    {
        $list = scandir('backups', SCANDIR_SORT_DESCENDING);

        return view('override', compact('list'));
    }

    public function backupSQL()
    {
        MySql::create()
             ->setDbName(env('DB_DATABASE'))
             ->setUserName(env('DB_USERNAME'))
             ->setPassword(env('DB_PASSWORD'))
             ->dumpToFile('backups/BACKUP_' . Carbon::now()->format('Y-m-d_h:i:sa') . '.sql');

        Alert::success('Created Restore Point', 'Restore Point Created!');

        return redirect()->back();
    }

    public function restoreSQL(Request $request)
    {
        $cmd = "mysql -u " . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " " . env('DB_DATABASE') . " < backups/$request->dumpsql";
        exec($cmd);

        Alert::success('Back Restored', 'Successful Restored!');

        return redirect()->back();
    }

    public function databaseWipe(Request $request)
    {
        if($request->db){
            switch ($request->db) {
                case 'po':
                    DB::table('purchase_info')->delete();
                    DB::table('product_details')->whereNull('sales_order_id')->delete();
                case 'so':
                    DB::table('sales_orders')->delete();
                    DB::table('product_details')->whereNull('purchase_order_id')->delete();
            }
            Alert::success('DB Wiped Successful!', 'Successful Wiped!');
        } else {
            Alert::success('DB Wiped Failed!', 'Please try again!');
        }


        return redirect()->back();
    }
}
