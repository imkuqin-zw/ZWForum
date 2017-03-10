@extends('layout.default')
@section('title',$user->name.'-回复列表')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/markdown.css') }}">
@endsection
@section('content')
    <div class="container border-color main-container">
        <div class="col-md-3">
            @include('user.components.userBaseInfo')
            @include('user.components.userInfoMenu')
        </div>
        <div class="col-md-9 ">

            <ol class="breadcrumb panel" style="border-color: #d9edf7; ">
                <li><a href="{{route('user.show',$user->id)}}">个人中心</a></li>
                <li class="active">Ta 发表的回复</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($replies->total())
                        <ul class="list-group">
                            @foreach($replies as $reply)
                                <li class="list-group-item">
                                    <a href="{{route('topic.show',$reply->topic->id)}}" title="{{$reply->topic->title}}">{{$reply->topic->title}}</a>
                                    <span class="meta">
                                        at <span data-toggle="tooltip" data-original-title="{{$reply->created_at}}" title="{{$reply->created_at}}">{{$reply->created_at->diffForHumans()}}</span>
                                    </span>
                                    <div class="reply-body markdown-reply content-body">
                                        {!! $reply->content !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="pull-right">
                            @if($replies->lastPage() == 1)
                                <div class="pagination">
                                    <span style="color:#8b8a8a">已经是最后一页了</span>
                                </div>
                            @else
                                {!! $replies->render() !!}
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