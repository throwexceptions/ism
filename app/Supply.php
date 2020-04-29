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
        $data = self::query()
            ->select(['product_id', 'type'])
            ->join('products','products.id', 'supplies.product_id')
            ->get()
            ->toArray();

        foreach ($data as $value) {
            $real_val = 0 ;
            if($value['type'] == 'limited') {
                $so = DB::table('sales_orders')
                    ->join('product_details', 'product_details.sales_order_id', '=', 'sales_orders.id')
                    ->where('sales_orders.status', 'Shipped')
                    ->where('product_id', $value['product_id'])
                    ->sum('product_details.qty');

                $po = DB::table('purchase_infos')
                    ->join('product_details', 'product_details.purchase_order_id', '=', 'purchase_infos.id')
                    ->where('purchase_infos.status', 'Received')
                    ->where('product_id', $value['product_id'])
                    ->sum('product_details.qty');

                $real_val = $po - $so;
            }
            self::query()->where('product_id', $value['product_id'])->update(['quantity' => $real_val]);
        }
    }
}
