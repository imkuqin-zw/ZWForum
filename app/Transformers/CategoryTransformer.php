<?php
/**
 * Created by PhpStorm.
 * User: Zhangwei
 * Date: 2017/3/14
 * Time: 11:50
 */

namespace App\Transformers;


class CategoryTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'description' => $model->description,
            'created_at' => $model->created_at,
            'link' => [
                'topic_cate_list' => route('api.topic.getTopicByCate', $model->id)
            ]
        ];
    }

}