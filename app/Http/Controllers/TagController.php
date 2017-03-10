<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    /**
     * show the topics with the tag id.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id){
        $filter = ($request->get('filter'))? :'default';
        switch ($filter){
            case "default": $topics = $this->tag->getPageOrderByDefault($id);break;
            case "excellent": $topics = $this->tag->getPageWithExcellent($id);break;
            case "vote": $topics = $this->tag->getPageOrderByVote($id);break;
            case "noreply": $topics = $this->tag->getPageWithNoreply($id);break;
            case "recent": $topics = $this->tag->getPageOrderByNew($id);break;
            default : $topics = $this->tag->getPageOrderByDefault($id);break;
        }
        $tag = $id;
        return view('tag.show',compact('topics','filter','tag'));
    }
}
