<?php

namespace App\Http\Controllers;

use App\Events\ReplyMention;
use App\Http\Requests\ReplyForm;
use App\Repositories\ReplyRepository;
use App\Zwforum\Traits\ReplyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class ReplyController extends Controller
{
    use ReplyHelper;
    /**
     * @var ReplyRepository
     */
    public $reply;

    /**
     * ReplyController constructor.
     *
     * @param ReplyRepository $reply
     */
    public function __construct(ReplyRepository $reply)
    {
        $this->reply = $reply;

    }

    /**
     * Store a newly created reply in storage.
     *
     * @param ReplyForm $requests
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ReplyForm $requests)
    {
        $data = $requests->only('content','topic_id');
        $data['content'] = $this->parse($data['content']);
        if($this->reply->isDuplicate($data))
            return redirect()->back()->withInput()->withErrors('请不要重复提交评论！');
        try{
            $reply = $this->reply->createReply($data);
            $toUsers = $this->users;
            if(count($toUsers))
                Event::fire(new ReplyMention($reply,$toUsers));
            return redirect(route('topic.show',$data['topic_id']));
        }catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
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
        $reply = $this->reply->getById($id);
        if(Auth::user()->id != $reply->user_id)
            abort(403);
        try{
            $this->reply->deleteReply($id);
            return redirect(route('topic.show',$reply->topic->id));
        }catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
}
