<?php
/**
 * Created by PhpStorm.
 * User: Zhangwei
 * Date: 2017/3/10
 * Time: 13:09
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Socialite;

class AuthController extends Controller
{
    public $user;

    /**
     * AuthController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        //parent::__construct();
        $this->user = $user;

    }

    /**
     * 将用户重定向到Github认证页面
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * 从Github获取用户信息.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        if(!User::where('github_id',$user->id)->orWhere('email',$user->email)->first()){
            $data['github_id'] = $user->id;
            $data['name'] = $user->name;
            return view('auth.github')->with($data);
        }
        $userInstance = User::where('github_id',$user->id)->orWhere('email',$user->email)->firstOrFail();
        Auth::login($userInstance);

        return redirect()->route('/');

    }

    /**
     * 通过github注册账号
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function githuRegister(Request $request){
        $data = $request->only('name','github_id','email','password');
        $validator = Validator::make($data, [
            'name' => 'required',
            'github_id' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator)
                    ->with($data);
        }
        $user = $this->user->create($data);
        Auth::login($user);

        return redirect('/');
    }

    /**
     * 绑定github账号
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function githuBind(Request $request){
        $data = $request->only('name','github_id','email','password');
        $validator = Validator::make($data, [
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator)
                ->with($data);
        }

        $user = $this->user->getByEmail($data['email']);

        if(!$user || !Hash::check($data['password'], $user->password)){
            return redirect()->back()
                ->withInput()
                ->withErrors('用户不存在或密码错误！')
                ->with($data);
        }
        if($user->github_id){
            return redirect()->back()
                ->withInput()
                ->withErrors('账号已绑定github账号！')
                ->with($data);
        }

        $this->user->update($user->id,$data['github_id']);
        Auth::login($user);

        return redirect('/');
    }
}