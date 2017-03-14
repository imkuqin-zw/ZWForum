<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:06
 */

namespace App\Transformers;


class TopicCategoryTransformer extends BaseTransformer
{
    public function transformData($model)
    {

        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'link' => [
                'topic_cate_list' => route('api.topic.getTopicByCate', $model->id)
            ]
        ];

    }
}