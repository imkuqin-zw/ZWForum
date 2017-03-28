<?php
/**
 * Created by PhpStorm.
 * User: Zhangwei
 * Date: 2017/3/14
 * Time: 17:17
 */

namespace App\Transformers;


class UserTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'portrait_min' => $model->portrait_min,
            'portrait_mid' => $model->portrait_mid,
            'portrait_max' => $model->portrait_max,
            'name' => $model->name,
            'created_at' => $model->created_at,
            'description' => $model->description,
            'topic_count' => $model->topic_count,
            'collection_count' => $model->collection_count,
            'reply_count' => $model->reply_count,
            //'is_banned' => $model->is_banned,
            //'is_admin' => $model->is_admin,
            'github_name' => $model->github_name,
            'real_name' => $model->real_name,
            'city' => $model->city,
            'company' => $model->company,
            'weibo_name' => $model->weibo_name,
            'weibo_link' => $model->weibo_link,
            'twitter_account' => $model->twitter_account,
            'personal_website' => $model->personal_website,
        ];
    }
}