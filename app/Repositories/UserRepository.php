<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:35
 */

namespace App\Repositories;

use App\Model\Followers;
use App\Model\Reply;
use App\Model\Topic;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * 通过Email获取用户
     *
     * @param $input
     * @return mixed
     */
    public function getByEmail($input){
       return $this->model->where('email',$input)->first();
    }

    /**
     * Store a newly created user resource in storage and atache to roles.
     *
     * @param $input
     * @return \App\User
     * @throws \Exception
     */
    public function createUser($input){
        DB::beginTransaction();
        try {
            $user = $this->create($input);
            $user->roles()->sync($input['roles']);
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return $user;
    }

    /**
     * update the specified user resource in storage and atache to roles.
     *
     * @param $id
     * @param $input
     * @return \App\User
     * @throws \Exception
     */
    public function updateUser($id,$input){
        DB::beginTransaction();
        try {
            $user = $this->update($id,$input);
            $user->roles()->sync($input['roles']);
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return $user;
    }

    /**
     * get the all topics of the user.
     *
     * @param $id
     * @param int $number
     * @return mixed
     */
    public function getAllTopics($id,$number=30)
    {
        return Topic::where('user_id',$id)
            ->whereHas('category',function($q){
                $q->where('is_blocked','no');
            })->paginate($number);
    }

    /**
     * get the all replies of the user.
     *
     * @param $id
     * @param int $number
     * @return mixed
     */
    public function getAllReplies($id,$number=20)
    {
        return Reply::where('user_id',$id)
            ->whereHas('topic.category',function($q){
                $q->where('is_blocked','no');
            })->paginate($number);
    }

    /**
     * get the all collection topics of the user.
     *
     * @param $id
     * @param int $number
     * @return mixed
     */
    public function getAllVotes($id,$number=30)
    {
        return Topic::leftJoin('topic_user','topics.id','=','topic_user.topic_id')
            ->where('topics.user_id','!=',$id)
            ->where('topic_user.user_id',$id)->paginate($number);
    }

    /**
     * get the all followers of the user.
     *
     * @param $id
     * @param int $number
     * @return mixed
     */
    public function getAllFollowers($id,$number=20)
    {
        return User::leftJoin('followers','users.id','=','followers.follower_id')
            ->where('followers.user_id',$id)->paginate($number);
    }

    /**
     * 获得关注我的人
     *
     * @param $id
     * @param int $number
     * @return mixed
     */
    public function getAllFans($id,$number=20){
        return User::leftJoin('followers','users.id','=','followers.user_id')
            ->where('followers.follower_id',$id)->paginate($number);
    }

    /**
     * get the topic count of the user.
     *
     * @param $id
     * @return mixed
     */
    public function getTopicCount($id){
        return Topic::where('user_id',$id)
            ->whereHas('category',function($q){
                $q->where('is_blocked','no');
            })->count();

    }


    /**
     * 获得被收藏的话题
     *
     * @param $id
     * @param int $number
     * @return mixed
     */
    public function getCollectionTopics($id,$number = 30){
        return Topic::leftJoin('topic_user','topics.id','=','topic_user.topic_id')
            ->where('topics.user_id',$id)
            ->where('topic_user.user_id','!=',$id)->paginate($number);
    }

    /**
     * 获得被加精的文章
     *
     * @param $id
     * @param int $number
     * @return mixed
     */
    public function getALLExcellences($id,$number = 30){
        return Topic::where('is_excellent','yes')
            ->where('user_id',$id)
            ->paginate($number);
    }

    /**
     * 获得被加精的文章的数量
     *
     * @param $id
     * @return mixed
     */
    public function getExcellenceCount($id)
    {
        return Topic::where('is_excellent','yes')
            ->where('user_id',$id)
            ->count();
    }

    /**
     * get the collection count of the user.
     *
     * @param $id
     * @return mixed
     */
    public function getCollectionCount($id)
    {
        return Topic::leftJoin('topic_user','topics.id','=','topic_user.topic_id')
            ->where('topics.user_id',$id)
            ->where('topic_user.user_id','!=',$id)->count();
    }

    /**
     * update the password
     *
     * @param $id
     * @param $input
     * @return \App\Repositories\User|bool
     */
    public function updatePassword($id,$input)
    {
        $user = $this->getById($id);
        if(!Hash::check($input['old_password'], $user->password))
            return false;
        return $this->save($user, ['password' => Hash::make($input['password'])]);
    }

    /**
     * get the recent topics.
     *
     * @param $id
     * @param $number
     * @return mixed
     */
    public function getRecentTopics($id,$number=10){
        return Topic::where('user_id',$id)->orderBy('created_at','desc')
                ->whereHas('category',function($q){
                    $q->where('is_blocked','no');
                })->take($number)->get();
    }

    /**
     * get the recent replies.
     *
     * @param $id
     * @param $number
     * @return mixed
     */
    public function getRecentReplies($id, $number=10){
        return Reply::where('user_id',$id)->orderBy('created_at','desc')
            ->whereHas('topic.category',function($q){
                $q->where('is_blocked','no');
            })->take($number)->get();
    }

    /**
     * Add the follower info in storage.
     *
     * @param $input
     */
    public function follower($input){
        DB::transaction(function ($input) use ($input) {
            try{
                $user = $this->getById($input['follower_id']);
                Followers::create($input);
                $user->increment('follower_count');
            }catch (\Exception $e){
                throw $e;
            }

        });
    }

    /**
     * Remove the follower from the storage.
     *
     * @param $id
     */
    public function deletefollower($id){
        DB::transaction(function ($id) use ($id) {
            try {
                Followers::where(['user_id'=>Auth::id(),'follower_id'=>$id])->delete();
                $this->model->where('id',$id)->decrement('follower_count');
            } catch (\Exception $e) {
                throw $e;
            }
        });
    }

    /**
     * 搜索用户
     *
     * @param $query
     * @param int $number
     * @return mixed
     */
    public function search($query,$number = 30){
        return $this->model->search($query, null, true)->limit(5)->get();
    }

}