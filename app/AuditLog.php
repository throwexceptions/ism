<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    public static function record($request)
    {
        $model = new self;
        $model->user = $request['name'];
        $model->inputs = json_encode($request['inputs']);
        $model->url = $request['url'];
        $model->save();

        return 'success';
    }
}
