<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:06
 */

namespace App\Transformers;


use App\Model\Topic;
use App\User;
use League\Fractal\TransformerAbstract;

class SearchTransformer extends TransformerAbstract
{
    public function transform(Topic $topic,User $user)
    {
        return [
            'id' => $topic->id,
            'user' => $model->user->name,
            'user_id' => $model->user_id,
            'user_potrait' => $model->user->portrai_min,
            'content' => $model->content,
            'created_at' => $model->created_at->toDateTimeString()
        ];
    }
}