<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:08
 */

namespace App\Transformers;

class TopicTagTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'link' => [
                'topic_tag_list' => route('api.topic.getTopicByTag',$model->id)
            ]
        ];
    }
}