<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:06
 */

namespace App\Transformers\Admin;

use App\Transformers\BaseTransformer;

class PermsTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => (int) $model->id,
//            'name' => $model->name,
//            'display_name' => $model->display_name,
            'type' => $model->type
        ];
    }
}