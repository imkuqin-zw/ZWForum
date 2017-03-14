<?php
/**
 * Created by PhpStorm.
 * User: Zhangwei
 * Date: 2017/3/15
 * Time: 2:00
 */

namespace App\Transformers;


class ReplyListTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'topic_id' => $model->topic_id,
            'content' => $model->content,
            'topic' => $model->topic->title,
            'created_at' => $model->created_at->toDateTimeString()
        ];
    }
}