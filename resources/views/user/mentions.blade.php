@extends('layout.default')
@section('title','提及到我')
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    <div class="container main-container">
        @include('layout.error')
        <div class="col-md-3 user-show border-color">
            <div class="panel panel-body text-center">
                <ul class="list-group">
                    <a href="{{route('user.notifications')}}" >
                        <li class="list-group-item "><span>话题通知 <span class="badge" @if($notificationsCount)style="background-color: #d15b47"@endif  >{{  $notificationsCount }}</span></span></li>
                    </a>
                    <a href="{{route('user.mentions')}}" >
                        <li class="list-group-item active">
                            <span>提及到我&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
                        </li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-9 border-color">
            <div class="panel panel-default padding-md">
                <div class="panel-body ">
                    <h2>
                        {{--<i class="text-md glyphicon glyphicon-lock" aria-hidden="true"></i>--}}
                        &nbsp;话题通知
                    </h2>
                    <hr>
                    @if(count($notifications))
                        <ul class="list-group ">
                            @foreach($notifications as $notification)
                                <li class="list-group-item">
                                    <a href="{{route('user.show',$notification->topic->user->id)}}" title="{{$notification->topic->user->name}}">
                                        <img class="img-thumbnail avatar-middle avatar avatar-small inline-block " src="@if($notification->topic->user->portrait_min){{asset('uploads/portraits/'.$notification->topic->user->portrait_min)}}@else{{asset('uploads/portraits/portraits/profile-pic_min.png')}}@endif">
                                        {{$notification->topic->user->name}}
                                    </a>
                                    <span class="introduction">
                                     • 在话题中提及你
                            </span>
                                    <a href="{{route('topic.show',$notification->topic_id)}}">{{$notification->topic->title}}</a>
                                    <span class="meta">
                                 • 于 • <abbr class="timeago popover-with-html" data-toggle="tooltip"  data-original-title="{{$notification->topic->created_at}}" title="{{$notification->topic->created_at}}">{{$notification->topic->created_at->diffForHumans()}}</abbr>
                            </span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="pull-right">
                            <div class="pull-right">
                                @if($notifications->lastPage() == 1)
                                    <div class="pagination">
                                        <span style="color:#8b8a8a">已经是最后一页了</span>
                                    </div>
                                @else
                                    {!! $notifications->render() !!}
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="empty-block">没有任何数据~~</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection