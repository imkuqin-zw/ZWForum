@extends('layout.default')
@section('title','github登录')
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
        <div class=" panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#already" aria-controls="already" role="tab" data-toggle="tab">绑定已有账号</a></li>
                    <li role="presentation" class=""><a href="#new" aria-controls="new" role="tab" data-toggle="tab">注册新账号</a></li>
                </ul>
                <div class="tab-content panel-body">
                    <div role="tabpanel" class="tab-pane fade in active" id="already">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.githuBind') }}">
                            {{ csrf_field() }}
                            <input name="github_id" type="hidden" value="{{ $github_id }}" >
                            <input name="name" type="hidden" value="{{ $name }}" >
                            <div class="form-group">
                                <label for="email_register" class="col-md-3 control-label">邮箱</label>
                                <div class="col-md-6">
                                    <input id="email_register" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-3 control-label">密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        绑定
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade"  id="new">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.githuRegister') }}">
                            {{ csrf_field() }}
                            <input name="github_id" type="hidden" value="{{ $github_id }}" >
                            <div class="form-group">
                                <label for="name_register" class="col-md-3 control-label">昵称</label>
                                <div class="col-md-6">
                                    <input id="name_register" type="text" class="form-control" name="name" value="{{ old('name')? :$name }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_register" class="col-md-3 control-label">邮箱</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password_register" class="col-md-3 control-label">密码</label>
                                <div class="col-md-6">
                                    <input id="password_register" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-md-3 control-label">确认密码</label>
                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">
                                        注册
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
