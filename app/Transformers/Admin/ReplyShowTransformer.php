<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:06
 */

namespace App\Transformers\Admin;


use App\Transformers\BaseTransformer;

class ReplyShowTransformer extends BaseTransformer
{
    public function transformData($model)
    {
        return [
           'content' => $model->content
        ];
    }
}