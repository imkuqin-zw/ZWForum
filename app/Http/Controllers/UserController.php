<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowerForm;
use App\Repositories\UserRepository;
use App\Zwforum\Image\ImageUpload;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserForm;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ImageUpload;
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * UserController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        //parent::__construct();
        $this->user = $user;
    }

    /**
     * show the user's topics list page.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTopicsList($id){
        $user = $this->user->getById($id);
        $topics = $this->user->getAllTopics($id);
        $topicCount = $this->user->getTopicCount($id);
        $collectionCount = $this->user->getCollectionCount($id);
        $userMenu = 'topic';
        return view('user.userTopics',compact('topics','user','topicCount','collectionCount','userMenu'));
    }

    /**
     * show the user's replies list page.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRepliesList($id){
        $user = $this->user->getById($id);
        $replies = $this->user->getAllReplies($id);
        $topicCount = $this->user->getTopicCount($id);
        $collectionCount = $this->user->getCollectionCount($id);
        $userMenu = 'reply';
        return view('user.userReplies',compact('replies','user','topicCount','collectionCount','userMenu'));
    }

    /**
     * show the user's votes list page.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getVotesList($id){
        $user = $this->user->getById($id);
        $topics = $this->user->getAllVotes($id);
        $topicCount = $this->user->getTopicCount($id);
        $collectionCount = $this->user->getCollectionCount($id);
        $userMenu = 'vote';
        return view('user.userVotes',compact('topics','user','topicCount','collectionCount','userMenu'));
    }

    /**
     * show the user's follwer list page.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getfollowerList($id){
        $user = $this->user->getById($id);
        $followers = $this->user->getAllFollowers($id);
        $topicCount = $this->user->getTopicCount($id);
        $collectionCount = $this->user->getCollectionCount($id);
        $userMenu = 'follower';
        return view('user.userFollowers',compact('followers','user','topicCount','collectionCount','userMenu'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->getById($id);
        $recentTopics = $this->user->getRecentTopics($id,10);
        $recentReplies = $this->user->getRecentReplies($id,10);
        $topicCount = $this->user->getTopicCount($id);
        $collectionCount = $this->user->getCollectionCount($id);
        $userMenu = 'default';
        return view('user.show',compact('userMenu','user','recentTopics','recentReplies','topicCount','collectionCount','userMenu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPortrait($id){
        return view('user.portrait');
    }

    /**
     * 上传用户头像并保存路径到数据库
     *
     * @param UpdateUserForm $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePortrait(UpdateUserForm $request, $id){
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
                return redirect()->back()->with('status','更新成功！');
            } catch (ImageUploadException $exception) {
                return redirect()->back()->withErrors($exception->getMessage());
            }catch ( QueryException $e){
                @unlink($folderName.$portrait['portrait_min']);
                @unlink($folderName.$portrait['portrait_mid']);
                @unlink($folderName.$portrait['portrait_max']);
            }
        } else {
            return redirect()->back()->withErrors('更新失败！');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        return view('user.password');
    }

    /**
     * Alert the password.
     *
     * @param UpdateUserForm $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdateUserForm $request, $id)
    {
        $data = $request->only(['old_password','password','password_confirmation']);
        if($this->user->updatePassword($id,$data))
            return redirect()->back()->with('status', '更新成功！');
        else
            return redirect()->back()->withInput()->withErrors('更新失败！');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserForm  $request
     * @param  int  $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserForm $request, $id)
    {
        $data = $request->except(['id','email','create_at','update_at','delete_at']);
        if($this->user->update($id,$data)){
            return redirect()->back()->with('status', '更新成功！');
        }else{
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    /**
     * Create an association relationship between the user and user.
     *
     * @param FollowerForm $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function follower(FollowerForm $request){
        $data['user_id'] = Auth::id();
        $data['follower_id'] = $request->input('follower_id');
        $this->user->follower($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function followerDestroy($id)
    {
        $this->user->deletefollower($id);
        return redirect()->back();
    }
}
