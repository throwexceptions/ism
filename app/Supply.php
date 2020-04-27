<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function recalibrate()
    {
        $product_id = self::query()->get('product_id')->toArray();

        foreach ($product_id as $id) {
            $so = DB::table('sales_orders')
                ->join('product_details', 'product_details.sales_order_id', '=', 'sales_orders.id')
                ->where('sales_orders.status', 'Shipped')
                ->where('product_id', $id)
                ->sum('product_details.qty');

            $po = DB::table('purchase_infos')
                ->join('product_details', 'product_details.purchase_order_id', '=', 'purchase_infos.id')
                ->where('purchase_infos.status', 'Received')
                ->where('product_id', $id)
                ->sum('product_details.qty');

            $real_val = $po - $so;

            self::query()->where('product_id', $id)->update(['quantity' => $real_val]);
        }
    }
}
