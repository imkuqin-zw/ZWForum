<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/8
 * Time: 21:50
 */

namespace App\Transformers\Admin;


use App\Transformers\BaseTransformer;

class RoleUpdateTransformer extends BaseTransformer
{
    protected $defaultIncludes = ['perms'];
    public function transformData($model)
    {

        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'display_name' => $model->display_name,
            'description' => $model->description,
        ];
    }

    public function includePerms($model)
    {
        return $this->collection($model->perms, new PermsTransformer());
    }
}