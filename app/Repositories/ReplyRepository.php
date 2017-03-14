<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:36
 */

namespace App\Repositories;

use App\Model\Reply;
use App\Model\Topic;
use App\Zwforum\Markdown\Markdown;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReplyRepository extends BaseRepository
{

    /**
     * ReplyRepository constructor.
     *
     * @param Reply $reply
     */
    public function __construct(Reply $reply)
    {
        $this->model = $reply;
    }


    /**
     * Store a newly created reply in storage.
     *
     * @param $input
     * @return mixed
     * @throws \Exception
     */
    public function createReply($input)
    {
        $input['user_id'] = Auth::user()->id;
        DB::beginTransaction();
        try {
            $reply = $this->create($input);
            $reply->topic()->increment('reply_count');
            $reply->user()->increment('reply_count');
            $topic = Topic::findOrFail($input['topic_id']);
            $topic->fill(['update_at' => Carbon::now()->toDateTimeString(),'reply_at' => Carbon::now()->toDateTimeString()])->save();
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return $reply->id;
    }

    /**
     * Remove the specified reply from storage.
     *
     * @param $id
     * @throws \Exception
     */
    public function deleteReply($id){
        DB::transaction(function($id) use ($id){
           try{
               $reply = $this->getById($id);
               $reply->topic()->decrement('reply_count');
               $reply->user()->decrement('reply_count');
               $reply->delete();
           } catch (\Exception $e){
               DB::rollback();
               throw $e;
           }
        });
    }

    /**
     * check for duplicate submission.
     *
     * @param $data
     * @return bool
     */
    public function isDuplicate($data){
        $last_reply = $this->model->where('user_id', Auth::id())
                        ->where('topic_id', $data['topic_id'])
                        ->orderBy('id', 'desc')
                        ->first();
        return count($last_reply) && strcmp($last_reply->content, $data['content']) === 0;
    }

    public function getTopicReply($id,$number = 10){
        //
        return $this->model->orderBy('created_at', 'desc')->where('topic_id',$id)->paginate($number);

    }
}