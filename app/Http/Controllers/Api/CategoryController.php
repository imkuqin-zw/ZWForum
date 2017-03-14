<?php

namespace App\Http\Controllers\Api;

use App\Repositories\CategoryRepository;
use App\Repositories\TopicRepository;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends ApiController
{
    protected $category;

    /**
     * CategoryController constructor.
     *
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * 获得没有禁止显示的分类
     *
     * @return \Illuminate\Http\Response
     */
    public function showList(){
        $where['is_blocked'] = 'no';
        $categorys = $this->category->getCategory($where);
        return $this->respondWithCollection($categorys, new CategoryTransformer());
    }

    /**
     * 获得没有禁用的分类
     *
     * @return \Illuminate\Http\Response
     */
    public function editList(){
        $where['is_display'] = 'no';
        $categorys = $this->category->getCategory($where);
        return $this->respondWithCollection($categorys, new CategoryTransformer());
    }

}
