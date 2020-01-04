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
            $build[$value->name] = $value->status == 1 ? true : false;
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
            } else {
                Preference::query()->where('name', $key)->update(['status' => '0']);
            }
        }
    }
}
