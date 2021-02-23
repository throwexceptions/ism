<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    protected $guarded = ['id'];

    public static function fetchDataPO($purchase_order_id)
    {
        return self::query()
            ->where('purchase_order_id', $purchase_order_id)
            ->get()
            ->toArray();
    }

    public static function fetchDataSO($sales_order_id)
    {
        return self::query()
            ->where('sales_order_id', $sales_order_id)
            ->get()
            ->toArray();
    }
}
