@extends('layout.default')
@section('title','修改头像')
@section('styles')
    <style>
        .avatar-preview-img {
            padding: 3px;
            border: 1px solid #c8dcdb;
            border-radius: 6px;
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
        <div class="col-md-3 border-color">
            <div class="panel panel-body text-center">
                <ul class="list-group">
                    <a href="{{route('user.edit',Auth::user()->id)}}">
                    <li class="list-group-item ">
                        <i class="text-md glyphicon glyphicon-list-alt" aria-hidden="true"></i> 个人信息
                    </li>
                    </a>
                    <a href="{{route('user.editPortrait',Auth::user()->id)}}" >
                        <li  class="list-group-item active">
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

        <div class="col-md-9 border-color">
            <div class="panel panel-default padding-md">
                <div class="panel-body ">
                    <h2>
                        <i class="text-md glyphicon glyphicon-picture" aria-hidden="true"></i>
                        &nbsp;修改头像
                    </h2>
                    <hr>
                    <form class="form-horizontal" method="POST" action="{{route('user.updatePortrait',Auth::User()->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        {{csrf_field()}}
                        <div>
                            <label for="exampleInputFile">请选择图片：</label>
                            <br><img id="preview-img" class="avatar-preview-img" src="{{(Auth::User()->portrait_mid)? (asset('uploads/portraits/'.Auth::User()->portrait_mid)):asset('uploads/portraits/profile-pic_mid.png') }}">
                        </div>
                        <div class="form-group">
                            <input class="col-sm-6" type="file" name="portrait" id="file" required="" />
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <input class="btn btn-primary"  type="submit" value="上传头像">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection