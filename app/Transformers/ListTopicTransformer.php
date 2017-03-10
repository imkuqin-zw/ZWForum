<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/12
 * Time: 23:28
 */

namespace App\Transformers;


class ListTopicTransformer extends BaseTransformer
{
    protected $availableIncludes = [];

    protected $defaultIncludes = ['user', 'category'];

    public function transformData($model)
    {
        return [
            "id" => $model->id,
            "title" => $model->title,
            "reply_count" => $model->reply_count,
            "vote_count" => $model->vote_count,
            "view_count" => $model->view_count,
            "time" => $model->created_at->toDataTimeString(),
            'links' => [
                'details_topic' => route('api.topic.show', $model->id),
            ],
        ];
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }

    public function includeCategory($model)
    {
        return $this->item($model->category, new CategoryTransformer());
    }
}