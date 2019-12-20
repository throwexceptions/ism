<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bouncer;
use Yajra\DataTables\DataTables;
use DB;

class SecurityController extends Controller
{
    public $array_role = [
        'batch_process',
        'batch_process_create',
        'batch_process_retrieve',
        'batch_process_update',
        'batch_process_delete',
        'purchase_order',
        'purchase_order_create',
        'purchase_order_retrieve',
        'purchase_order_update',
        'purchase_order_delete',
    ];

    public function roles()
    {
        return view('security');
    }

    public function table()
    {
        return DataTables::of(DB::table('roles'))->make(true);
    }

    public function create()
    {
        foreach ($this->array_role as $key => $value) {
            $abilities[$value] = false;
        }

        $role      = '';
        $abilities = collect($abilities);

        return view('security_form', compact('role', 'abilities'));
    }

    public function store(Request $request)
    {
        $data = $request->input();
        foreach ($data['abilities'] as $key => $value) {
            if ($value == "true") {
                Bouncer::assign($request->role)->to($key);
            } else {
                Bouncer::retract($request->role)->from($key);
            }
        }

        return ['success' => true];
    }

    public function show($id)
    {
        $role = DB::table('roles')->where('id', $id)->get()[0]->name;

        $ability_list = DB::table('assigned_roles')->where('role_id', $id)->pluck('entity_id')->toArray();

        foreach ($this->array_role as $key => $value) {
            if (in_array($value, $ability_list)) {
                $abilities[$value] = true;
            } else {
                $abilities[$value] = false;
            }
        }
        $abilities = collect($abilities);

        return view('security_form', compact('role', 'abilities'));
    }

    public function destroy(Request $request)
    {
        DB::table('roles')->where('id', $request->id)->delete();
        DB::table('assigned_roles')->where('role_id', $request->id)->delete();

        return ['success' => true];
    }
}
