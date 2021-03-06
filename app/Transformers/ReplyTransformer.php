<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:06
 */

namespace App\Transformers;


class ReplyTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'user' => $model->user->name,
            'user_id' => $model->user_id,
            'content' => $model->content,
            'created_at' => $model->created_at->toDateTimeString()
        ];
    }
}