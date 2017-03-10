<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/10
 * Time: 20:24
 */

namespace App\Repositories;

use App\Model\Category;
use App\Model\Topic;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * get topics with the category id.
     *
     * @param $id
     * @param int $number
     * @return mixed
     */
    public function getTopicByCate($id,$number = 20){
        return Topic::where('category_id',$id)
            ->orderBy('created_at','desc')
            ->paginate($number);
    }

    /**
     * validate whether the category is blocked.
     *
     * @param $id
     */
    public function validateBlocked($id){
        $this->model->where('is_blocked','no')->findOrFail($id);
    }
}