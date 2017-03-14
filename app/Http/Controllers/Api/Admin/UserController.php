<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CreateUserForm;
use App\Http\Requests\UpdateUserForm;
use App\Repositories\UserRepository;
use App\Transformers\Admin\UserListTransformer;
use App\Transformers\Admin\UserTransformer;
use App\User;
use App\Zwforum\Image\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
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
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('list-user'))
            abort(403);
        $users = $this->user->page(20);
        return $this->respondWithPaginator($users, new UserListTransformer());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserForm $request)
    {
        if(!Auth::user()->can('create-user'))
            abort(403);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = $this->user->createUser($data);
        $file = $request->input('portrait');
        if ($file && $file != '') {
            $folderName = public_path().'/uploads/portraits/';
            $portrait = $this->savePortraitByBase64($file,$user->id);
            $user->fill($portrait);
            if(!$user->save()){
                @unlink($folderName.$portrait['portrait_min']);
                @unlink($folderName.$portrait['portrait_mid']);
                @unlink($folderName.$portrait['portrait_max']);
            }
        }
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
        $user = $this->user->getById($id);

        return $this->respondWithItem($user,new UserTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserForm  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserForm $request, $id)
    {
        if(!Auth::user()->can('edit-user'))
            abort(403);
        $data = $request->all();
        if ($data['password']!='')
            $data['password'] = Hash::make($data['password']);
        else
            unset($data['password']);
        $user = $this->user->updateUser($id,$data);
        $file = $request->input('portrait');
        $oldPortrait['portrait_min'] = $user->portrait_min;
        $oldPortrait['portrait_mid'] = $user->portrait_mid;
        $oldPortrait['portrait_max'] = $user->portrait_max;
        if ($file && $file != '') {
            $folderName = public_path().'/uploads/portraits/';
            $portrait = $this->savePortraitByBase64($file,$user->id);
            $user->fill($portrait);
            if(!$user->save()){
                @unlink($folderName.$portrait['portrait_min']);
                @unlink($folderName.$portrait['portrait_mid']);
                @unlink($folderName.$portrait['portrait_max']);
            }else{
                @unlink($folderName.$oldPortrait['portrait_min']);
                @unlink($folderName.$oldPortrait['portrait_mid']);
                @unlink($folderName.$oldPortrait['portrait_max']);
            }
        }
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
        if(!Auth::user()->can('delete-user'))
            abort(403);
        $user = $this->user->getById($id);
        $portrait['portrait_min'] = $user->portrait_min;
        $portrait['portrait_mid'] = $user->portrait_mid;
        $portrait['portrait_max'] = $user->portrait_max;
        if($user->delete()){
            $folderName = public_path().'/uploads/portraits/';
            @unlink($folderName.$portrait['portrait_min']);
            @unlink($folderName.$portrait['portrait_mid']);
            @unlink($folderName.$portrait['portrait_max']);
        }

        $this->noContent();
    }

    /**
     * get all the permissions of the user.
     *
     * @return json
     */
    public function getPerms(){
        $roles = Auth::user()->roles;
        $perms = [];
        foreach ($roles as $role)
            foreach ($role->perms as $perm)
                if(!isset($perms[$perm->type]) || !in_array($perm->name,$perms[$perm->type]))
                    $perms[$perm->type][] = $perm->name;

        return $this->respondWithArray($perms);
    }
}
