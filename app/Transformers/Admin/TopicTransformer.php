<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:06
 */

namespace App\Transformers\Admin;


use App\Transformers\BaseTransformer;

class TopicTransformer extends BaseTransformer
{
    //protected $availableIncludes = [];

//    protected $defaultIncludes = ['user', 'category'];

    public function transformData($model)
    {
        return [
            "id" => $model->id,
            "title" => $model->title,
            "reply_count" => $model->reply_count,
            "vote_count" => $model->vote_count,
            "is_top" => $model->is_top,
            "is_blocked" => $model->is_blocked,
            "is_excellent" => $model->is_excellent,
            "user" => $model->user->name,
            "category" => $model->category->name,
            "created_at" => $model->created_at->toDateTimeString(),
        ];
    }

//    public function includeUser($model)
//    {
//        return $this->item($model->user, new UserTransformer());
//    }
//
//    public function includeCategory($model)
//    {
//        return $this->item($model->category, new CategoryTransformer());
//    }
}