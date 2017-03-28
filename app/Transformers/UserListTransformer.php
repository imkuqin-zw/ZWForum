<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/25
 * Time: 18:01
 */

namespace App\Transformers;

class UserListTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'portrait_min' => $model->portrait_min?:'profile-pic_min.png',
            'name' => $model->name,
            'created_at' => $model->created_at->toDateTimeString(),
            'topic_count' => $model->topic_count,
            'reply_count' => $model->reply_count,
            'is_banned' => $model->is_banned,
//            'link' =>[
//                //'user_base_info' => route('api.getBaseInfo',$model->id),
//            ]
        ];
    }

}