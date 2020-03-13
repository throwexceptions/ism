<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $fillable = [];

    public static function decreCount($product_id, $quantity)
    {
        self::query()->where('product_id', $product_id)->decrement('quantity', $quantity);
    }


    public static function increCount($product_id, $quantity)
    {
        self::query()->where('product_id', $product_id)->increment('quantity', $quantity);
    }
}
