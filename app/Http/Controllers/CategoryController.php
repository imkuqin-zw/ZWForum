<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    protected $topic;

    public function __construct(CategoryRepository $category,TopicRepository $topic)
    {
        $this->category = $category;
        $this->topic = $topic;
    }

    public function index(){

    }

    /**
     * show the topics with the category id.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id){
        $filter = ($request->get('filter'))? :'default';
        $where['category_id'] = $id;
        $this->category->validateBlocked($id);
        switch ($filter){
            case "default": $topics = $this->topic->getPageOrderByDefault(20,$where);break;
            case "excellent": $topics = $this->topic->getPageWithExcellent(20,$where);break;
            case "vote": $topics = $this->topic->getPageOrderByVote(20,$where);break;
            case "noreply": $topics = $this->topic->getPageWithNoreply(20,$where);break;
            case "recent": $topics = $this->topic->getPageOrderByNew(20,$where);break;
            default : $topics = $this->topic->getPageOrderByDefault(20,$where);break;
        }
        $nav_category = $id;
        return view('category.show',compact('topics','filter','nav_category'));
    }
}
