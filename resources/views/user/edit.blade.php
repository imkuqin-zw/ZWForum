@extends('layout.default')
@section('title','编辑个人资料')
@section('styles')
    <style>
        .user-show .list-group .list-group-item {
            border-bottom: 1px solid #f2f2f2 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container main-container">
        @if (session('status'))
            <div class="alert text-center alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{ session('status') }}</strong>
            </div>
        @endif
        @include('layout.error')
        <div class="col-md-3 user-show border-color ">
            <div class="panel panel-body text-center">
                <ul class="list-group">
                    <a href="{{route('user.edit',Auth::user()->id)}}"  >
                        <li class="list-group-item active">
                            <i class="text-md glyphicon glyphicon-list-alt" aria-hidden="true"></i> 个人信息
                        </li>
                    </a>
                    <a href="{{route('user.editPortrait',Auth::user()->id)}}" >
                        <li class="list-group-item">
                            <i class="text-md glyphicon glyphicon-picture" aria-hidden="true"></i> 修改头像
                        </li>
                    </a>
                    {{--<a href="#" >--}}
                        {{--<li class="list-group-item">--}}
                            {{--<i class="text-md glyphicon glyphicon-bell" aria-hidden="true"></i> 消息通知--}}
                        {{--</li>--}}
                    {{--</a>--}}
                    {{--<a href="https://laravel-china.org/users/4032/edit_social_binding" class="list-group-item ">--}}
                    {{--<i class="text-md glyphicon glyphicon-flask" aria-hidden="true"></i>--}}
                    {{--&nbsp;账号绑定--}}
                    {{--</a>--}}
                    <a  href="{{route('user.editPassword',Auth::user()->id)}}">
                        <li style="border-bottom: none !important;" class="list-group-item">
                            <i class="text-md glyphicon glyphicon-lock" aria-hidden="true"></i> 修改密码
                        </li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-9  left-col border-color">
            <div class="panel panel-default padding-md">
                <div class="panel-body ">
                    <h2>
                        <i class="glyphicon glyphicon-cog" aria-hidden="true"></i> 编辑个人资料</h2>
                    <hr>
                    <form class="form-horizontal" method="POST" action="{{route('user.update',Auth::User()->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">GitHub Name</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="github_name" type="text" value="{{Auth::User()->github_name}}">
                            </div>
                            <div class="col-sm-4 help-block">
                                请跟 GitHub 上保持一致
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">昵称</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="name" type="text" value="{{Auth::User()->name}}">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：狼族少年
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">真实姓名</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="real_name" type="text" value="{{Auth::User()->real_name}}">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：李小明
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">城市</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="city" type="text" value="{{Auth::User()->city}}">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：北京、广州
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">公司</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="company" type="text" value="{{Auth::User()->company}}">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：阿里巴巴
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">微博用户名</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="weibo_name" type="text" value="{{Auth::User()->weibo_name}}">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：Overtrue
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">微博个人页面</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="weibo_link" type="text" value="{{Auth::User()->weibo_link}}">
                            </div>
                            <div class="col-sm-4 help-block">
                                微博个人主页链接，如：http://weibo.com/laravelnews
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Twitter 帐号</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="twitter_account" type="text" value="{{Auth::User()->twitter_account}}">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：summer_charlie
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">个人网站</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="personal_website" type="text" value="{{Auth::User()->personal_website}}">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：example.com，不需要加前缀 https://
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">个人简介</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="3" name="description" cols="50" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{Auth::User()->description}}</textarea>
                            </div>
                            <div class="col-sm-4 help-block">
                                请一句话介绍你自己，大部分情况下会在你的头像和名字旁边显示
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <input class="btn btn-primary"  type="submit" value="应用修改">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection