@extends('layout.default')
@section('title',$user->name.'-个人信息')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/markdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prism.css') }}">
@endsection
@section('content')
    <div class="container border-color main-container">
        <div class="col-md-3">
        @include('user.components.userBaseInfo')
        @include('user.components.userInfoMenu')
        </div>
        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading">个人信息</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            GitHub Name：<strong><a href="https://github.com/{{$user->github_name}}" target="_blank" >{{$user->github_name}}</a></strong>
                        </li>
                        <li class="list-group-item">
                            城市：<strong>{{$user->city}}</strong>
                        </li>
                        <li class="list-group-item">
                            公司：<strong>{{$user->company}}</strong>
                        </li>
                        <li class="list-group-item">
                            微博：<strong><a target="_blank" href="{{$user->weibo_link}}" >{{$user->weibo_name}}</a></strong>
                        </li>
                        <li class="list-group-item">
                            Twitter 帐号：<strong>{{$user->twitter_account}}</strong>
                        </li>
                        <li class="list-group-item">
                            个人网站：<strong>{{$user->personal_website}}</strong>
                        </li>
                        <li class="list-group-item">
                            座右铭：<strong>{{$user->description}}</strong>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">最近话题</div>
                <div class="panel-body">
                    @if(count($recentTopics))
                        <ul class="list-group">
                        @foreach($recentTopics as $recentTopic)
                            <li class="list-group-item">
                                <a href="{{route('topic.show',$recentTopic->id)}}" title="{{$recentTopic->title}}">{{$recentTopic->title}}</a>
                                <span class="meta">
                                    <a href="{{route('category.show',$recentTopic->category->id)}}" title="{{$recentTopic->category->name}}">{{$recentTopic->category->name}}</a>
                                    <span> ⋅ </span> {{$recentTopic->vote_count}} 点赞 <span> ⋅ </span> {{$recentTopic->reply_count}} 回复 <span> ⋅ </span>
                                    <span data-toggle="tooltip" data-original-title="{{$recentTopic->created_at}}" title="{{$recentTopic->created_at}}">{{$recentTopic->created_at->diffForHumans()}}</span>
                                </span>
                            </li>
                        @endforeach
                        </ul>
                    @else
                    <div class="empty-block">没有任何数据~~</div>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">最近回复</div>
                <div class="panel-body">
                    @if(count($recentReplies))
                        <ul class="list-group">
                            @foreach($recentReplies as $recentReply)
                                <li class="list-group-item">
                                    <a href="{{route('topic.show',$recentReply->topic->id)}}" title="{{$recentReply->topic->title}}">{{$recentReply->topic->title}}</a>
                                    <span class="meta">
                                        at <span data-toggle="tooltip" data-original-title="{{$recentReply->created_at}}" title="{{$recentReply->created_at}}">{{$recentReply->created_at->diffForHumans()}}</span>
                                    </span>
                                    <div class="reply-body markdown-reply content-body">
                                        {!! $recentReply->content !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="empty-block">没有任何数据~~</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/prism.js')}}"></script>
    <script>
      $(function () {
        $("[data-toggle='tooltip']").tooltip({
          container: "body"
        });
      });
      function voteClick(id) {
        alert(id);
      }
    </script>
@endsection