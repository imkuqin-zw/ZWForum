<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Transformers\Admin\ReplyShowTransformer;
use App\Transformers\Admin\ReplyTransformer;
use Illuminate\Http\Request;
use App\Repositories\ReplyRepository;
use Illuminate\Support\Facades\Auth;

class replyController extends ApiController
{

    /**
     * @var ReplyRepository
     */
    protected $reply;

    /**
     * replyController constructor.
     *
     * @param ReplyRepository $reply
     */
    public function __construct(ReplyRepository $reply)
    {
        parent::__construct();
        $this->reply = $reply;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('list-reply'))
            abort(403);
        $replies = $this->reply->page(20);
        return $this->respondWithPaginator($replies,new ReplyTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->can('show-reply'))
            abort(403);
        $reply = $this->reply->getById($id);
        return $this->respondWithItem($reply,new ReplyShowTransformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->can('delete-reply'))
            abort(403);
        $this->reply->deleteReply($id);

        return $this->noContent();
    }
}
