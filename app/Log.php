<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['user_id', 'remarks'];

    public static function write($remarks)
    {
        static::create(['user_id' => auth()->user()->id, 'remarks' => $remarks]);
    }
}
