<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class SalesOrder extends Model
{
    use SoftDeletes;

    public static function generate()
    {
        return new static;
    }

    public function newSONo()
    {
        if(Preference::verify('so_auto') == 0) {
            return '';
        }

        $so_no_list = $this->newQuery()
                           ->where('so_no', 'like', '%SO%')
                           ->orderBy('id', 'desc')
                           ->limit(1)
                           ->get()
                           ->toArray();
        $str_length = 5;
        $year       = Carbon::now()->format('y');

        if (isset($so_no_list[0]["so_no"])) {
            $so_no = $so_no_list[0]["so_no"];
        }

        if (count($so_no_list) == 0 || substr(explode('-', $so_no)[0], -2) != $year) {
            $num = 1;
            $str = substr("0000{$num}", -$str_length);

            return 'SO' . $year . '-' . $str;
        } else {
            $numbering = explode('-', $so_no)[1];
            $year      = Carbon::now()->format('y');
            $final_num = (int)$numbering + 1;
            $str       = substr("0000{$final_num}", -$str_length);

            return 'SO' . $year . '-' . $str;
        }
    }
}
