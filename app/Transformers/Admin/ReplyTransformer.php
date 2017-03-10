<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:06
 */

namespace App\Transformers\Admin;


use App\Transformers\BaseTransformer;

class ReplyTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'user' => $model->user->name,
            'topic' => $model->topic->title,
            'created_at' => $model->created_at->toDateTimeString()
        ];
    }
}