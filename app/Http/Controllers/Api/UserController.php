<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateUserForm;
use App\Repositories\UserRepository;
use App\Transformers\UserFollowerTransformer;
use App\Transformers\UserListTransformer;
use App\Transformers\TopicListTransformer;
use App\Transformers\ReplyListTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * 获得用户基本信息
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getBaseInfo($id){
        $user = $this->user->getById($id);
        $user['topic_count'] = $this->user->getTopicCount($id);
        $user['collection_count'] = $this->user->getCollectionCount($id);
        return $this->respondWithItem($user,new UserTransformer());
    }

    /**
     * 获得用户发表的话题
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getUserTopic(Request $request, $id){
        $number = ($request->get('num'))? :20;
        $topics = $this->user->getAllTopics($id,$number);
        return $this->respondWithPaginator($topics,new TopicListTransformer());
    }

    /**
     * 获得用户发表的评论
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getUserReply(Request $request, $id){
        $number = ($request->get('num'))? :20;
        $topics = $this->user->getAllReplies($id,$number);
        return $this->respondWithCollection($topics,new ReplyListTransformer());
    }

    /**
     * 获得用户收藏的话题
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    Public function getUserVote(Request $request, $id){
        $number = ($request->get('num'))? :20;
        $topics = $this->user->getAllVotes($id,$number);
        return $this->respondWithCollection($topics,new TopicListTransformer());
    }

    /**
     * 获得用户关注的用户
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getUserFollower(Request $request, $id){
        $number = ($request->get('num'))? :20;
        $users = $this->user->getAllFollowers($id,$number);
        return $this->respondWithCollection($users,new UserFollowerTransformer());
    }

    /**
     * 更新用户密码
     *
     * @param UpdateUserForm $request
     * @param $id
     * @return \App\Zwforum\Traits\json|\Illuminate\Http\Response
     */
    public function updatePassword(UpdateUserForm $request, $id){
        if(Auth::user()->id != $id) {
            $this->setStatusCode(403);
            return $this->respondWithError('用户未授权！');
        }
        $data = $request->only(['old_password','password','password_confirmation']);
        if($this->user->updatePassword($id,$data))
            return $this->noContent();
        else
            return $this->errorWrongArgs('更新失败');
    }

    /**
     * 更新用户信息
     *
     * @param UpdateUserForm $request
     * @param $id
     * @return \App\Zwforum\Traits\json|\Illuminate\Http\Response
     */
    public function update(UpdateUserForm $request, $id)
    {
        if(Auth::user()->id != $id) {
            $this->setStatusCode(403);
            return $this->respondWithError('用户未授权！');
        }
        $data = $request->except(['id','email','create_at','update_at','delete_at']);
        if($this->user->update($id,$data)){
            return $this->noContent();
        }else{
            return $this->errorWrongArgs('更新失败');
        }
    }

    /**
     * 上传用户头像并保存路径到数据库
     *
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePortrait(Request $request, $id){
        if(Auth::user()->id != $id) {
            $this->setStatusCode(403);
            return $this->respondWithError('用户未授权！');
        }
        if ($file = $request->file('portrait')) {
            try {
                $folderName = public_path().'/uploads/portraits/';
                $oldPortrait = $this->user->getById($id,['portrait_min','portrait_mid','portrait_max']);
                $portrait = $this->updatePortraitImg($file,$id);
                $this->user->update($id,$portrait);
                if($oldPortrait->portrait_min){
                    @unlink($folderName.$oldPortrait->portrait_min);
                    @unlink($folderName.$oldPortrait->portrait_mid);
                    @unlink($folderName.$oldPortrait->portrait_max);
                }
                return $this->noContent();
            } catch (ImageUploadException $exception) {
                return $this->errorWrongArgs('更新失败');
            }catch ( QueryException $e){
                @unlink($folderName.$portrait['portrait_min']);
                @unlink($folderName.$portrait['portrait_mid']);
                @unlink($folderName.$portrait['portrait_max']);
            }
        } else {
            return $this->errorWrongArgs('更新失败');
        }
    }

    public function isBanned(){
        return $this->errorWrongArgs('对不起，你的账号已被管理员禁用！');
    }
}
