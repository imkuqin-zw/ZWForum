@extends('layout.default')
@section('title','登录')
<style>
</style>
@section('content')
<div class="container">
    @if($errors->first())
        <div class="alert text-center alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{$errors->first()}}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">登录</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">邮箱</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    登录
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    忘记密码
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 side-bar">
            <div class="panel panel-default corner-radius panel-active-users">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">其它登录方式</h3>
                </div>
                <div class="panel-body text-center" style="padding-top: 5px;">
                    <a href="{{ route('auth.github') }}"  title="GitHub 登录" class="btn btn-default" style="width:100%;height:40px; font-size: 18px;padding:8px 0;">
                        GitHub 登录
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
