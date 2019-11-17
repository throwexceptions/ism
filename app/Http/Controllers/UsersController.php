<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Log;
use App\User;
use Illuminate\Http\Request;
use Bouncer;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public $output;

    const ABILITIES = [
        'view-dashboard',
        'view-costumers',
        'view-products',
        'view-shipment',
        'view-users',
        'view-logs',
    ];

    public function __construct()
    {
        foreach (self::ABILITIES as $ability) {
            $this->output[$ability] = false;
        }
    }

    public function table()
    {
        return DataTables::of(User::all())->make(true);
    }

    public function getAbilities(Request $request)
    {
        $user_abilities = User::find($request->id)->getAbilities();

        foreach (self::ABILITIES as $ability) {
            foreach ($user_abilities as $user_ability) {
                if ($ability == $user_ability->name) {
                    $this->output[$ability] = true;
                }
            }
        }

        return ['output'=>$this->output, 'list' => self::ABILITIES];
    }

    public function myAbilities()
    {
        $user_abilities = User::find(auth()->user()->id)->getAbilities();

        foreach (self::ABILITIES as $ability) {
            foreach ($user_abilities as $user_ability) {
                if ($ability == $user_ability->name) {
                    $this->output[$ability] = true;
                }
            }
        }

        return ['output'=>$this->output, 'list' => self::ABILITIES];
    }

    public function updateAbilities(Request $request)
    {
        $request->input();
        $user = User::find($request['overview']['id']);
        foreach ($request['abilities'] as $item => $key) {
            dump($key);
            if ($key == "true") {
                Bouncer::allow($user)->to($item);
            } else {
                Bouncer::disallow($user)->to($item);
            }
        }

        return ['success' => true];
    }

    public function store(UserRequest $request)
    {
        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Log::write($request->name . ' user has been added!');

        foreach (self::ABILITIES as $ability) {
            Bouncer::allow($user)->to($ability);
        }

        return ['success' => true];
    }

    public function update(Request $request)
    {
        $user        = User::find($request->id);
        $user->name  = $request->name;
        $user->email = $request->email;
        if ($request->password != 'sample') {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        Log::write($request->namee . ' user has been updated!');

        return ['success' => true];
    }

    public function destroy(Request $request)
    {
        User::destroy($request->id);

        return ['success' => true];
    }
}
