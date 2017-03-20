<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:07
 */

namespace App\Transformers;

use App\Model\User;

class TopicUserTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => $model->id,
            'description' => $model->description,
            'portrait_min' => $model->portrait_min,
            'name' => $model->name,
            'link' =>[
                'base_info' => route('api.user.getBaseInfo',$model->id),
                'user_topic_list' => route('api.user.getUserTopic',$model->id),
                'user_Vote_list' => route('api.user.getUserVote',$model->id),
                'base_follower_list' => route('api.user.getUserFollower',$model->id),
            ]
        ];
    }
}