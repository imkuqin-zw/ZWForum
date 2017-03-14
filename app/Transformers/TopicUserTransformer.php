<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:07
 */

namespace App\Transformers;

use App\Model\User;

class TopicUserTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'description' => $model->description,
            'portrait_min' => $model->portrait_min,
            'name' => $model->name,
            'link' =>[
                'details_user' => route('api.user.show',$model->id),
            ]
        ];
    }
}