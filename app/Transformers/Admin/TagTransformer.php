<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:08
 */

namespace App\Transformers\Admin;


use App\Transformers\BaseTransformer;

class TagTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'description' => $model->description,
            'is_blocked' => $model->is_blocked,
            'is_display' => $model->is_display,
            'topic_count' => $model->topic_count,
            'created_at' => $model->created_at->toDateTimeString(),
            'order' => $model->order,
            'links' => [
                'details' => route('api.admin.tag.edit', $model->id),
                'delete' => route('api.admin.tag.destroy', $model->id)
            ]
        ];
    }
}