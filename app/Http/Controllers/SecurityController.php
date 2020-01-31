<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Yajra\DataTables\DataTables;
use DB;

class SecurityController extends Controller
{
    public $array_abilities = [
        "order_form",
        "order_form_create",
        "order_form_retrieve",
        "order_form_delete",
        "purchase_order",
        "purchase_order_create",
        "purchase_order_retrieve",
        "purchase_order_update",
        "purchase_order_delete",
        "sales_order",
        "sales_order_create",
        "sales_order_retrieve",
        "sales_order_update",
        "sales_order_delete",
        "customer_delete",
        "customer_update",
        "customer_retrieve",
        "customer_create",
        "customer",
        "supplies",
        "vendors",
        "vendors_create",
        "supplies_create",
        "vendors_retrieve",
        "supplies_retrieve",
        "vendors_update",
        "supplies_update",
        "vendors_delete",
        "supplies_delete",
        "products",
        "security",
        "user_accounts",
        "user_accounts_create",
        "user_accounts_change_pass",
        "user_accounts_update",
        "user_accounts_delete",
        "products_create",
        "security_create",
        "products_retrieve",
        "security_retrieve",
        "products_update",
        "security_update",
        "products_delete",
        "security_delete",
        "preference",
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
        foreach ($this->array_abilities as $key => $value) {
            $abilities[$value] = false;
        }

        $role      = '';
        $abilities = collect($abilities);

        return view('security_form', compact('role', 'abilities'));
    }

    public function store(Request $request)
    {
        $data = $request->input();
        Bouncer::allow($data['role'])->to('manage');
        foreach ($data['abilities'] as $key => $value) {
            if ($value == "true") {
                Bouncer::allow($data['role'])->to($key);
            }
        }

        return ['success' => true];
    }

    public function show($id)
    {
        $role = DB::table('roles')->where('id', $id)->get()[0]->name;

        $ability_ids = DB::table('permissions')->where('entity_id', $id)->get()->pluck('ability_id');

        $ability_list = DB::table('abilities')->whereIn('id', $ability_ids)->pluck('name')->toArray();

        foreach ($ability_list as $key => $value) {
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
