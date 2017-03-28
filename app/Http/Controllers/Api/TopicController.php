<?php

namespace App\Http\Controllers\Api;

use App\Events\NewTopic;
use App\Http\Requests\CreateTopicForm;
use App\Http\Requests\UpdateTopicForm;
use App\Repositories\TopicRepository;
use App\Transformers\ShowTopicTransformer;
use App\Transformers\ListTopicTransformer;
use App\Transformers\TopicListTransformer;
use App\Zwforum\Image\ImageUpload;
use App\Zwforum\Markdown\Markdown;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class topicController extends ApiController
{
    use ImageUpload;
    /**
     * @var topicRepository
     */
    protected $topic;

    /**
     * topicController constructor.
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = ($request->get('filter'))? :'default';
        $number = ($request->get('num'))? :20;
        switch ($filter){
            case "default": $topics = $this->topic->getPageOrderByDefault($number);break;
            case "excellent": $topics = $this->topic->getPageWithExcellent($number);break;
            case "vote": $topics = $this->topic->getPageOrderByVote($number);break;
            case "noreply": $topics = $this->topic->getPageWithNoreply($number);break;
            case "recent": $topics = $this->topic->getPageOrderByNew($number);break;
            default : $topics = $this->topic->getPageOrderByDefault($number);break;
        }

        return $this->respondWithPaginator($topics, new TopicListTransformer());
    }

    /**
     * Display a listing of the resource with the specified category.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getTopicByCate(Request $request,$id)
    {
        $filter = ($request->get('filter'))? :'default';
        $number = ($request->get('num'))? :20;
        $where['category_id'] = $id;
        switch ($filter){
            case "default": $topics = $this->topic->getPageOrderByDefault($number,$where);break;
            case "excellent": $topics = $this->topic->getPageWithExcellent($number,$where);break;
            case "vote": $topics = $this->topic->getPageOrderByVote($number,$where);break;
            case "noreply": $topics = $this->topic->getPageWithNoreply($number,$where);break;
            case "recent": $topics = $this->topic->getPageOrderByNew($number,$where);break;
            default : $topics = $this->topic->getPageOrderByDefault($number,$where);break;
        }

        return $this->respondWithPaginator($topics, new TopicListTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  createTopicForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTopicForm $request)
    {
        $topicData = $request->only('title','content','category_id','tags');
        if($topicData['tags'])
            $topicData['tags'] = explode(',', $topicData['tags']);
        if($this->topic->isDuplicate($topicData)){
            return $this->errorWrongArgs('请不要发布重复内容！');
        }
        $markdown = new Markdown;
        $topicData['content'] = $markdown->convertMarkdownToHtml($topicData['content']);
        $topicData['user_id'] = Auth::user()->id;
        $topic = $this->topic->createTopic($topicData);
        Event::fire(new NewTopic($topic));
        return $this->created();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topics = $this->topic->getById($id);
        $topics->increment('view_count');
        return $this->respondWithItem($topics, new ShowTopicTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTopicForm $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicForm $request, $id)
    {

        $topicData = $request->only('id','title','content','category_id','tags');
        if(!$this->topic->isCheckedAuth($id)){
            return $this->errorWrongArgs("该用户没有此帖！");
        }
        $markdown = new Markdown;
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
        $this->topic->forceDelete($id);
        return $this->noContent();
    }

//    /**
//     * move the specified resource to the recycle bin.
//     *
//     * @param $id
//     * @return \Illuminate\Http\Response
//     */
//    public function softDelete($id){
//        $this->topic->softDelete($id);
//        return $this->noContent();
//    }

//    /**
//     * remove the specified resource from the recycle bin.
//     *
//     * @param $id
//     * @return \Illuminate\Http\Response
//     */
//    public function restore($id){
//        $this->topic->restore($id);
//        return $this->noContent();
//    }


    /**
     * 上传图片
     *
     * @param Request $request
     * @return mixed
     */
    public function uploadImg(Request $request)
    {
        if ($file = $request->file('file')) {
            try {
                $upload_status = $this->uploadImage($file);
            } catch (ImageUploadException $exception) {
                return ['error' => $exception->getMessage()];
            }
            $data['filename'] = $upload_status['filename'];
        } else {
            $data['error'] = '上传错误！';
        }
        return $data;
    }

}
