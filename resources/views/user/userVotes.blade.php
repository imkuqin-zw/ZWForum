@extends('layout.default')
@section('title',$user->name.'-点赞列表')

@section('content')
    <div class="container border-color main-container">
        <div class="col-md-3">
            @include('user.components.userBaseInfo')
            @include('user.components.userInfoMenu')
        </div>
        <div class="col-md-9 ">

            <ol class="breadcrumb panel" style="border-color: #d9edf7; ">
                <li><a href="{{route('user.show',$user->id)}}">个人中心</a></li>
                <li class="active">Ta 赞过的话题</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($topics->total())
                        <ul class="list-group">
                            @foreach($topics as $topic)
                                <li class="list-group-item">
                                    <a href="{{route('topic.show',$topic->id)}}" title="{{$topic->title}}">{{$topic->title}}</a>
                                    <span class="meta">
                                    <a href="{{route('category.show',$topic->category->id)}}" title="{{$topic->category->name}}">{{$topic->category->name}}</a>
                                    <span> ⋅ </span> {{$topic->vote_count}} 点赞 <span> ⋅ </span> {{$topic->reply_count}} 回复 <span> ⋅ </span>
                                    <span data-toggle="tooltip" data-original-title="{{$topic->created_at}}" title="{{$topic->created_at}}">{{$topic->created_at->diffForHumans()}}</span>
                                </span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="pull-right">
                            @if($topics->lastPage() == 1)
                                <div class="pagination">
                                    <span style="color:#8b8a8a">已经是最后一页了</span>
                                </div>
                            @else
                                {!! $topics->render() !!}
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