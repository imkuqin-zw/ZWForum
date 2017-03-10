@extends('layout.default')
@section('title','话题列表')
@section('styles')
@endsection
@section('content')
    <div class="container border-color main-container" >
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="list-inline topic-filter"  >
                        <li data-toggle="tooltip" data-original-title="最后回复排序"  title=""><a  href="{{route('category.show',[$nav_category, 'filter'=>'default'])}}" @if($filter == 'default')class="active"@endif >活跃</a></li>
                        <li data-toggle="tooltip" data-original-title="只看加精的话题" title=""><a href="{{route('category.show',[$nav_category, 'filter'=>'excellent'])}}" @if($filter == 'excellent')class="active"@endif  >精华</a></li>
                        <li data-toggle="tooltip" data-original-title="点赞数排序" title=""><a href="{{route('category.show',[$nav_category, 'filter'=>'vote'])}}" @if($filter == 'vote')class="active"@endif  >投票</a></li>
                        <li data-toggle="tooltip" data-original-title="发布时间排序" title=""><a href="{{route('category.show',[$nav_category, 'filter'=>'recent'])}}" @if($filter == 'recent')class="active"@endif  >最近</a></li>
                        <li data-toggle="tooltip" data-original-title="无人问津的话题" title=""><a href="{{route('category.show',[$nav_category, 'filter'=>'noreply'])}}" @if($filter == 'noreply')class="active"@endif  >零回复</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="jscroll">
                    <div class="jscroll-inner">
                        @if(count($topics))
                            <div class="panel-body remove-padding-horizontal">
                                <ul class="list-group row topic-list">
                                    @foreach($topics as $topic)
                                        <li class="list-group-item ">
                                            <a class="reply_count_area hidden-xs pull-right" href="{{route('topic.show',$topic->id)}}">
                                                <div class="count_set">
                                                    <span data-toggle="tooltip" class="count_of_votes" title="投票数">{{$topic->vote_count}}</span>
                                                    <span data-toggle="tooltip" class="count_seperator">/</span>
                                                    <span data-toggle="tooltip" class="count_of_replies" title="回复数">{{$topic->reply_count}}</span>
                                                    <span data-toggle="tooltip" class="count_seperator">/</span>
                                                    <span data-toggle="tooltip" class="count_of_visits" title="查看数">{{$topic->view_count}}</span>
                                                    <span data-toggle="tooltip" class="count_seperator">|</span>
                                                    <abbr data-toggle="tooltip" title="" class="timeago popover-with-html" data-toggle="tooltip" data-original-title="{{$topic->created_at}}">{{$topic->created_at->diffForHumans()}}</abbr>
                                                </div>
                                            </a>
                                            <div class="avatar pull-left">
                                                <a href="{{route('user.show',$topic->user->id)}}" title="{{$topic->user->name}}">
                                                    <img class="media-object img-thumbnail avatar avatar-middle" alt="{{$topic->user->name}}" src="{{asset('uploads/portraits') . '/' }}{{($topic->user->portrait_min)? :"profile-pic_min.png"}}" />
                                                </a>
                                            </div>
                                            <div class="infos">
                                                <div class="media-heading">
                                                    @if($topic->category->name == '分享')
                                                        <span class="hidden-xs label label-success"><a style="width:25px;" href="{{route('category.show',$topic->category->id)}}" >{{$topic->category->name}}</a></span>
                                                    @elseif($topic->category->name == '问答')
                                                        <span class="hidden-xs label label-primary"><a style="width:25px;" href="{{route('category.show',$topic->category->id)}}" >{{$topic->category->name}}</a></span>
                                                    @elseif($topic->category->name == '招聘')
                                                        <span class="hidden-xs label label-info"><a style="width:25px;" href="{{route('category.show',$topic->category->id)}}" >{{$topic->category->name}}</a></span>
                                                    @else
                                                        <span class="hidden-xs label label-default"><a style="width:25px;" href="{{route('category.show',$topic->category->id)}}" >{{$topic->category->name}}</a></span>
                                                    @endif
                                                    <a href="{{route('topic.show',$topic->id)}}" title="{{$topic->title}}">
                                                        {{$topic->title}}
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="panel-footer text-right remove-padding-horizontal pager-footer" >
                                @if($topics->lastPage() == 1)
                                    <div class="pagination">
                                        <span style="color:#8b8a8a">已经是最后一页了</span>
                                    </div>
                                @else
                                    {!! $topics->render() !!}
                                @endif
                            </div>
                        @else
                            <div class="panel-body ">
                                <span style="color:#8b8a8a">暂无帖子，请君赐帖！</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 side-bar">
            @include('side.login')
            @include('side.hotTag')
            @include('side.hotTopic')
            @include('side.frend')
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
@section('script')
@endsection