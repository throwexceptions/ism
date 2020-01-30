<?php

namespace App\Http\Controllers;

use App\Preference;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function index()
    {
        $build      = [];
        $preference = Preference::query()->get();
        foreach ($preference as $value) {
            if($value->status == '1') {
                $build[$value->name] = true;
            } else if($value->status == '0') {
                $build[$value->name] = false;
            } else {
                $build[$value->name] = $value->status;
            }
        }
        $build = collect($build);

        return view('preference', compact('build'));
    }

    public function update(Request $request)
    {
        $data = $request->input();
        foreach ($data as $key => $value) {
            if($value == 'true'){
                Preference::query()->where('name', $key)->update(['status' => '1']);
            } else if ($value == 'false') {
                Preference::query()->where('name', $key)->update(['status' => '0']);
            } else {
                Preference::query()->where('name', $key)->update(['status' => $value]);
            }
        }
    }
}
