<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    public static function call()
    {
        return new static;
    }

    public static function verify($name)
    {
        return self::query()->where('name', $name)->get()->toArray()[0]['status'];
    }

}
