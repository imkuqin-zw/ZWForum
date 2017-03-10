<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:06
 */

namespace App\Transformers\Admin;


use App\Transformers\BaseTransformer;

class TopicUpdateTransformer extends BaseTransformer
{
    //protected $availableIncludes = [];

    protected $defaultIncludes = ['category','tags'];

    public function transformData($model)
    {
        return [
           // "id" => $model->id,
            "title" => $model->title,
            "is_top" => $model->is_top,
            "is_blocked" => $model->is_blocked,
            "content" => $model->content,
            "is_excellent" => $model->is_excellent,
            "user" => $model->user->name,
            "category" => $model->category->name,
        ];
    }

//    public function includeUser($model)
//    {
//        return $this->item($model->user, new UserTransformer());
//    }
//
    public function includeTags($model)
    {
        return $this->collection($model->tags, new TagTransformer());
    }
    public function includeCategory($model)
    {
        return $this->item($model->category, new CategoryTransformer());
    }
}