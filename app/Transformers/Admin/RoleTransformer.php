<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/8
 * Time: 21:50
 */

namespace App\Transformers\Admin;


use App\Transformers\BaseTransformer;

class RoleTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'display_name' => $model->display_name,
            'description' => $model->description,
            'created_at' => $model->created_at->toDateTimeString()
        ];
    }
}