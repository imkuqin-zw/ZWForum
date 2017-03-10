<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\UpdateTopicForm;
use App\Repositories\TopicRepository;
use App\Transformers\Admin\TopicTransformer;
use App\Transformers\Admin\TopicUpdateTransformer;
use App\Zwforum\Markdown\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends ApiController
{
    /**
     * @var TopicRepository
     */
    protected $topic;

    /**
     * TopicController constructor.
     *
     * @param TopicRepository $topic
     */
    public function __construct(TopicRepository $topic)
    {
        parent::__construct();
        $this->topic = $topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('list-topic'))
            abort(403);
        $topic = $this->topic->page(10);
        return $this->respondWithPaginator($topic,new TopicTransformer());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = $this->topic->getById($id);
        $markdown = new Markdown();
        $topic->content = $markdown->convertHtmlToMarkdown($topic->content);
        return $this->respondWithItem($topic,new TopicUpdateTransformer());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTopicForm  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicForm $request, $id)
    {
        if(!Auth::user()->can('edit-topic'))
            abort(403);
        $topicData = $request->only('category_id','title','tags','content','is_blocked','is_top','is_excellent');
        if($topicData['tags'])
            $topicData['tags'] = explode(',',$topicData['tags']);
        $markdown = new Markdown();
        $topicData['content'] = $markdown->convertMarkdownToHtml($topicData['content']);
        $this->topic->updateTopic($id,$topicData);
        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->can('delete-topic'))
            abort(403);
        $this->topic->forceDelete($id);
        return $this->noContent();
    }
}
