<?php

namespace App\Http\Controllers;

use App\Events\NewTopic;
use App\Http\Requests\CreateTopicForm;
use App\Http\Requests\VoteForm;
use App\Model\Followers;
use App\Model\Topic;
use App\Repositories\TopicRepository;
use App\User;
use App\Zwforum\Image\ImageUpload;
use App\Zwforum\Markdown\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use League\Flysystem\Exception;

class TopicController extends Controller
{
    use ImageUpload;

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
        //parent::__construct();
        $this->topic = $topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filter = ($request->get('filter'))? :'default';
        $topTopics = [];
        $topicTopId = [];
        if($filter == 'default' && (!$request->get('page') || $request->get('page') == 1)) {
            $topTopics = $this->topic->getTopTopics();
            foreach ($topTopics as $value)
                $topicTopId[] = $value->id;
        }
        switch ($filter){
            case "default": $topics = $this->topic->getPageOrderByDefault(20,null,$topicTopId);break;
            case "excellent": $topics = $this->topic->getPageWithExcellent();break;
            case "vote": $topics = $this->topic->getPageOrderByVote();break;
            case "noreply": $topics = $this->topic->getPageWithNoreply();break;
            case "recent": $topics = $this->topic->getPageOrderByNew();break;
            default : $topics = $this->topic->getPageOrderByDefault();break;
        }

        return view('topic.index',compact('topics','topTopics','filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['tags'] = $this->topic->getAllTag()->toJson();
        $data['categorys'] = $this->topic->getAllCategory()->toArray();
        return view('topic.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTopicForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTopicForm $request)
    {

        $topicData = $request->only('category_id','title','tags','content');
        if($topicData['tags'])
            $topicData['tags'] = explode(',',$topicData['tags']);
        if($this->topic->isDuplicate($topicData)){
            return redirect()->back()->withErrors('请不要发布重复内容！');
        }
        $topicData['content'] = app(Markdown::class)->convertMarkdownToHtml($topicData['content']);
        $topicData['user_id'] = Auth::user()->id;
        try{
            $topic = $this->topic->createTopic($topicData);
            Event::fire(new NewTopic($topic));
            //Notification::send($users, new InvoicePaid($invoice));
            return redirect(route('topic.show', $topic->id));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
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
        $topic->increment('view_count');
        $tags = $topic->tags->toArray();
        $user = '';
        $replies = $topic->replies;
        $isVoted = null;
        if(Auth::check()) {
            foreach ($replies as $reply)
                $user[] = $reply->user->name;
            //获取管理员
            $admins = User::where('is_admin', 'yes')->where('is_banned', 'no')->get();
            foreach ($admins as $admin)
                $user[] = $admin->name;
            //获取管理用户
            $followers = Followers::where('user_id', Auth::id())->select('follower_id')->get()->toArray();
            $followers = User::whereIn('id', $followers)->where('is_banned', 'no')->select('name')->get();
            foreach ($followers as $follower)
                $user[] = $follower->name;
            //去重并格式化@用户数组
            $user = array_unique($user);
            $user = \GuzzleHttp\json_encode($user);

            $isVoted = $this->topic->isVoted($id);
        }

        return view('topic.show',compact('topic','tags','replies','user','isVoted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = $this->topic->getById($id);
        if($topic->user_id != Auth::user()->id)
            abort(404);
        $topic->content = app(Markdown::class)->convertHtmlToMarkdown($topic->content);
        $tagsArray = [];
        foreach ($topic->tags as $tag){
            $tagsArray[] = \GuzzleHttp\json_encode(['name'=>$tag->name, 'id'=>$tag->id]);
        }
        $topic->tagJsons = $tagsArray;
        $tags = $this->topic->getAllTag()->toJson();
        $categorys = $this->topic->getAllCategory();
        return view('topic.edit',compact('topic','tags','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $topicData = $request->only('category_id','title','tags','content');
        if($topicData['tags'])
            $topicData['tags'] = explode(',',$topicData['tags']);

        $markdown = new Markdown();
        $topicData['content'] = $markdown->convertMarkdownToHtml($topicData['content']);
        try{
            $id = $this->topic->updateTopic($id,$topicData);
            return redirect(route('topic.show', $id));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = $this->topic->getById($id);
        if($topic->user_id != Auth::user()->id)
            abort(403);
        try {
            $this->topic->forceDelete($id);
            return redirect(route('topic.index'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * vote the topic.
     *
     * @param VoteForm $request
     * @return bool
     */
    public function vote(VoteForm $request){
        $topic_id = $request->input('topic_id');
        $this->topic->vote($topic_id);
    }

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
            $data['error'] = 'Error while uploading file';
        }
        return $data;
    }
}