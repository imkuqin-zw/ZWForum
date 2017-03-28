<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:06
 */

namespace App\Transformers;


class TopicTransformer extends BaseTransformer
{
    protected $availableIncludes = ['user', 'replies', 'category'];

    protected $defaultIncludes = [];

    public function transformData($model)
    {
        return [
            "id" => $model->id,
            "category_id" => $model->category_id,
            "title" => $model->title,
            "content" => $model->content,
            "reply_count" => $model->reply_count,
            "vote_count" => $model->vote_count,
            "vote_up" => (bool)$model->vote_up,
            "vote_down" => (bool)$model->vote_down,
            "updated_at" => $model->updated_at,
            'links' => [
                'details_web_view' => route('topic.web_view', $model->id),
                'replies_web_view' => route('replies.web_view', $model->id),
                'web_url'          => trim(config('app.url'), '/').'/topics/'.$model->id,
            ],
        ];
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }

    public function includeReplies($model)
    {
        return $this->collection($model->replies, new ReplyTransformer());
    }

    public function includeCategory($model)
    {
        return $this->item($model->category, new CategoryTransformer());
    }
}