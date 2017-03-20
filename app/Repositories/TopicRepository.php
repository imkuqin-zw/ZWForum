<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:31
 */

namespace App\Repositories;


use App\Model\Category;
use App\Model\Reply;
use App\Model\Tag;
use App\Model\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicRepository extends BaseRepository
{
    public function __construct(Topic $topic)
    {
        $this->model = $topic;
    }

    /**
     * Check whether you voted the topic.
     *
     * @param $id
     * @return bool
     */
    public function isVoted($id){
        $where = ['topic_id'=>$id,'user_id'=>Auth::user()->id];
        if(DB::table('topic_user')->where($where)->first())
            return true;
        return false;
    }

    /**
     * check for duplicate submission.
     *
     * @param $data
     * @return bool
     */
    public function isDuplicate($data){
        $last_topic = $this->model->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->first();
        return count($last_topic) && strcmp($last_topic->title, $data['title']) === 0;
    }

    /**
     * vote and collect the topic.
     *
     * @param $id
     */
    public function vote($id){
        $data['where'] = ['topic_id'=>$id,'user_id'=>Auth::user()->id];
        $collection = DB::table('topic_user')->where($data['where'])->first();
        $data['id'] = $id;
        if($collection) {
            DB::transaction(function ($data) use ($data) {
                try {
                    $this->model->where('id', $data['id'])->decrement('vote_count');
                    DB::table('topic_user')->where($data['where'])->delete();
                } catch (\Exception $e) {
                    throw $e;
                }
            });
        }else{
            DB::transaction(function ($data) use ($data) {
                try {
                    $this->model->where('id', $data['id'])->increment('vote_count');
                    DB::table('topic_user')->insert($data['where']);
                } catch (\Exception $e) {
                    throw $e;
                }
            });
        }
    }

    /**
     * get all categorys.
     *
     * @return mixed
     */
    public function getAllCategory(){
        $where = ['is_blocked'=>'no','is_display'=>'no'];
        return Category::select('name','id')->where($where)->get();
    }

    /**
     * get all Tags.
     *
     * @return mixed
     */
    public function getAllTag(){
        return Tag::select('name','id')->where('is_display','no')->get();
    }

    /**
     * Check whether the topic belong to the user.
     *
     * @param int $id
     * @return bool
     */
    public function isCheckedAuth($id){
        $userId = $this->getById($id,'user_id')->user_id;
        return count($userId) && $userId == Auth::id();
    }

    /**
     * move the specified resource to the recycle bin.
     *
     * @param $id
     */
    public function softDelete($id){
        DB::transaction(function($id) use ($id) {
            try {
                $topic = $this->model->findOrFail($id);
                $topic->category()->decrement('topic_count');
                $topic->user()->decrement('topic_count');
                $topic->tags()->decrement('topic_count');
                $topic->delete();
            } catch (\Exception $e) {
                throw $e;
            }
        });
    }

    /**
     * Remove the topic resource from the recycle bin.
     *
     * @param $id
     */
    public function restore($id){
        DB::transaction(function($id) use ($id) {
            try {
                $topic = $this->model->onlyTrashed()->findOrFail($id);
                $topic->category()->increment('topic_count');
                $topic->user()->increment('topic_count');
                $topic->tags()->increment('topic_count');
                $topic->restore();
            } catch (\Exception $e) {
                throw $e;
            }
        });
    }

    /**
     * Remove the topic resource from storage.
     *
     * @param int $id
     */
    public function forceDelete($id){
        DB::transaction(function($id) use ($id){
            try{
                $topic = $this->model->withTrashed()->findOrFail($id);
                if(!$topic->trashed()){
                    $topic->category()->decrement('topic_count');
                    $topic->user()->decrement('topic_count');
                    $topic->tags()->decrement('topic_count');
                }
                $topic->forceDelete();
            }catch (\Exception $e){
                throw $e;
            }

        });
    }

    /**
     * Store a newly created topic resource in storage.
     *
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function createTopic($data){
        DB::beginTransaction();
        try {
            $topic = $this->create($data);
            $topic->category()->increment('topic_count');
            $topic->user()->increment('topic_count');
            if($data['tags']){
                $topic->tags()->sync($data['tags']);
                $topic->tags()->increment('topic_count');
            }
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return $topic->id;
    }

    /**
     * Update the topic resource in storage.
     *
     * @param $id
     * @param array $data
     */
    public function updateTopic($id,$data){
        $data['id'] = $id;
        DB::transaction(function($data) use ($data) {
            try {
                $topic = $this->model->withTrashed()->findOrFail($data['id']);
                if(!$topic->trashed()) {
                    $topic->tags()->decrement('topic_count');
                    $flag = (int)$data['category_id'] == $topic->category_id;
                    if (!$flag)
                        $topic->category()->decrement('topic_count');
                    $topic->fill($data)->save();
                    $topic = $this->model->withTrashed()->findOrFail($data['id']);
                    if (!$flag)
                        $topic->category()->increment('topic_count');
                    if(isset($data['tags'])){
                        $topic->tags()->sync($data['tags']);
                        $topic->tags()->increment('topic_count');
                    }
                }else{
                    $topic = $topic->save($data);
                    if($data['tags'])
                        $topic->tags()->sync($data['tags']);
                }

            }catch (Exception $e){
                throw $e;
            }
        });
    }

    /**
     * Get page of the records belong to the specialed category.
     *
     * @param int $id
     * @param int $number
     * @param null $filter
     * @param string $sort
     * @param string $sortColumn
     * @return Paginate
     */
    public function getPageByCate($id,$number = 10,$filter=null, $sort = 'desc', $sortColumn = 'created_at'){
        $category = Category::where('is_blocked',no)->findOrFail($id);
        if($filter)
            $result = $this->model->where('category_id',$id)
                ->where('is_blocked','no')
                ->orderBy($sortColumn, $sort)
                ->filter($filter)->paginate($number);
        else
            $result = $this->model->where('category_id',$id)
                ->where('is_blocked','no')
                ->orderBy($sortColumn, $sort)->paginate($number);
        return $result;
    }

    /**
     * Get page of the records belong to the specialed tag.
     *
     * @param int $id
     * @param int $number
     * @param null $filter
     * @param string $sort
     * @param string $sortColumn
     * @return Paginate
     */
    public function getPageByTag($id,$number = 10,$filter=null, $sort = 'desc', $sortColumn = 'created_at')
    {
        $tag = Tag::find($id);
        if ($tag){
            if ($filter)
                $result = $tag->topics()->where('is_blocked','no')->orderBy($sortColumn, $sort)->filter($filter)->paginate($number);
            else{
                $result = $tag->topics()->where('is_blocked','no')->orderBy($sortColumn, $sort)->paginate($number);
            }
        }else{
            $result = new \Illuminate\Pagination\LengthAwarePaginator($tag, 0, $number, null, array());
        }

        return $result;
    }

    public function getPageOrderByDefault($number = 20,$where = null){
        $topics = $this->model->where('is_blocked','no')
            ->orderBy('reply_at','desc')
            ->orderBy('updated_at', 'desc');
        if($where)
            $topics = $topics->where($where)
                ->where('is_blocked','no')
                ->whereHas('category',function($q){
                    $q->where('is_blocked','no');
                })
                ->paginate($number);
        else
            $topics = $topics->whereHas('category',function($q){
                    $q->where('is_blocked','no');
                })->where('is_blocked','no')
                ->paginate($number);

        return $topics;
    }

    public function getPageWithExcellent($number = 20,$where = null){
         $topics = $this->model->orderBy('updated_at', 'desc')
             ->where('is_blocked','no')
            ->where('is_excellent', 'yes');
         if($where)
             $topics = $topics->where($where)
                 ->whereHas('category',function($q){
                     $q->where('is_blocked','no');
                 })->where('is_blocked','no')
                 ->paginate($number);
         else
             $topics = $topics->whereHas('category',function($q){
                     $q->where('is_blocked','no');
                 })->paginate($number);

        return $topics;
    }

    public function getPageOrderByVote($number = 20,$where = null){
        $topics = $this->model->orderBy('vote_count', 'desc');
        if($where)
            $topics = $topics->where($where)
                ->whereHas('category',function($q){
                    $q->where('is_blocked','no');
                })->where('is_blocked','no')
                ->paginate($number);
        else
            $topics = $topics->whereHas('category',function($q){
                    $q->where('is_blocked','no');
                })->where('is_blocked','no')
                ->paginate($number);

        return $topics;
    }

    public function getPageOrderByNew($number = 20,$where = null){
        $topics = $this->model->orderBy('created_at', 'desc');
        if($where)
            $topics = $topics->where($where)
                ->whereHas('category',function($q){
                    $q->where('is_blocked','no');
                })->where('is_blocked','no')
                ->paginate($number);
        else
            $topics = $topics->whereHas('category',function($q){
                    $q->where('is_blocked','no');
                })->where('is_blocked','no')
                ->paginate($number);

        return $topics;
    }

    public function getPageWithNoreply($number = 20,$where = null){
        $topics = $this->model->orderBy('updated_at', 'desc')
            ->where('reply_count', 'no');
        if($where)
            $topics = $topics->where($where)
                ->whereHas('category',function($q){
                    $q->where('is_blocked','no');
                })->where('is_blocked','no')
                ->paginate($number);
        else
            $topics = $topics->whereHas('category',function($q){
                    $q->where('is_blocked','no');
                })->where('is_blocked','no')
                ->paginate($number);

        return $topics;
    }

    public function getTopTopics(){
        return $this->model->where('is_top','yes')->whereHas('category',function($q){
                $q->where('is_blocked','no');
            })->where('is_blocked','no')
            ->get();
    }

}