@extends('layout.default')
@section('title',$user->name.'-关注列表')

@section('content')
    <div class="container border-color main-container">
        <div class="col-md-3">
            @include('user.components.userBaseInfo')
            @include('user.components.userInfoMenu')
        </div>
        <div class="col-md-9 ">

            <ol class="breadcrumb panel" style="border-color: #d9edf7; ">
                <li><a href="{{route('user.show',$user->id)}}">个人中心</a></li>
                <li class="active">Ta 关注的用户</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($followers->total())
                        <ul class="list-group ">
                            @foreach($followers as $follower)
                                <li class="list-group-item">
                                    <a href="{{route('user.show',$follower->id)}}" title="{{$follower->name}}">
                                        <img style="" class="img-thumbnail avatar-middle avatar avatar-small inline-block " src="{{asset('uploads/portraits').'/'}}{{($follower->portrait_min)?:'profile-pic_min.png'}}">
                                        {{$follower->name}}
                                    </a>
                                    @if($follower->description)
                                    <span class="introduction">
                                         - {{$follower->description}}
                                    </span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="pull-right">
                            @if($followers->lastPage() == 1)
                                <div class="pagination">
                                    <span style="color:#8b8a8a">已经是最后一页了</span>
                                </div>
                            @else
                                {!! $followers->render() !!}
                            @endif
                        </div>
                    @else
                        <div class="empty-block">没有任何数据~~</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection