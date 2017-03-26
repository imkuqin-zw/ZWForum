@extends('layout.default')
@section('title','搜索结果')
@section('styles')
<style>
    .avatar-66 {
        width: 66px;
        height: 66px;
    }
    .search-results {
        padding: 20px;
        line-height: 25px;
    }

    .search-results .highlight{
        color:#e07b7a;
    }
    .search-results a {
        color: #333;
    }
    .search-results .result {
        margin-bottom: 20px;
    }
    .search-results .result .info {
        margin-bottom: 6px;
        font-size: 12px;
    }
    .search-results .user-info {
        padding-top: 8px;
        padding-left: 8px;
    }

    .search-results .user.result {
        margin-top: 8px;
        margin-bottom: 0px;
    }
    .search-results .user .info {
        margin-top: 4px;
        font-size: 14px;
    }
    .search-results .user .info a:hover{
        text-decoration: underline;
    }
    .search-results .user .info.number {
        color: #666;
        font-size: 13px;
    }
    .search-results .result .info .date {
        color: #999;
        margin-left: 8px;
    }
    .search-results .panel-heading h3{
        color: #696969;
        font-size: 15px;
        margin-bottom: 12px;
    }

    .search-results .result {
        margin-bottom: 20px;
    }
    .search-results .result .title {
        font-size: 18px;
    }
    .search-results .result .title a:hover{
        text-decoration: underline;
    }
    .search-results .result .info .url a {
        color: #337ab7;
    }
    .search-results .result .info .url a:hover {
        color: #23527c;
        text-decoration: underline;
    }
    .search-results .avatar-small {
        width: 26px;
        height: 26px;
    }
</style>
@endsection
@section('content')
    <div class="container main-container border-color" >
        <div class="panel panel-default list-panel search-results">
            <div class="panel-heading">
                <h3 class="panel-title ">
                    <i class="fa fa-search"></i> 关于 “<span class="highlight">{{ $query }}</span>” 的搜索结果, 共 {{$count}} 条
                </h3>
            </div>
            <div class="panel-body ">
            @if(count($users) || count($topics))
                @foreach($users as $user)
                <div class="result user media">
                    <div class="media">
                        <div class="avatar media-left">
                            <div class="image"><a title="{{$user->name}}" href="{{ route('user.show',$user->id) }}">
                                <img class="media-object img-thumbnail avatar avatar-66" src="{{asset('uploads/portraits') . '/' }}{{($user->portrait_min)? :"profile-pic_min.png"}}" alt="96"></a>
                                    </div>
                                </div>
                                <div class="media-body user-info">
                                    <div class="info">
                                        <a href="{{ route('user.show',$user->id) }}">
                                            {!! preg_replace("/($query)/",'<span class="highlight" >$1</span>',$user->name) !!}
                                        </a>
                                    </div>
                                    <div class="info number">
                                        第 {{$user->id}} 位会员
                                        ⋅ <span title="注册日期">{{$user->created_at->format('Y-m-d')}}</span>
                                        ⋅ <span>{{$user->follower_count}}</span> 关注者
                                        ⋅ <span>{{$user->topic_count}}</span> 篇话题
                                        ⋅ <span>{{$user->reply_count}}</span> 条回帖
                                    </div>
                                </div>
                            </div>
                        </div>
                <hr>
                @endforeach
                @foreach($topics as $topic)
                        <div class="result">
                            <h2 class="title">
                                <a href="{{ route('topic.show',$topic->id) }}">{!! preg_replace("/($query)/",'<span class="highlight" >$1</span>',$topic->title) !!}</a>
                                <small>by</small>
                                <a href="{{ route('user.show',$topic->user->id) }}" title="{{ $topic->user->name }}">
                                    <img class="avatar avatar-small" alt="{{ $topic->user->name }}" src="{{asset('uploads/portraits') . '/' }}{{($topic->user->portrait_min)? :"profile-pic_min.png"}}">
                                    <small>{{ $topic->user->name }}</small>
                                </a>

                            </h2>
                            <div class="info">
                                <span class="url">
                                    <a href="{{ route('topic.show',$topic->id) }}">{{ route('topic.show',$topic->id) }}</a>
                                </span>
                                <span class="date" title="Last Updated At">
                                    {{ $topic->updated_at->format('Y-m-d') }}
                                    ⋅
                                    <i class="glyphicon glyphicon-eye-open"></i> {{ $topic->view_count }}
                                    ⋅
                                    <i class="glyphicon  glyphicon-thumbs-up"></i> {{ $topic->view_count }}
                                    ⋅
                                    <i class="glyphicon glyphicon-comment"></i> {{ $topic->reply_count }}

                              </span>

                            </div>
                            <div class="desc">
                                {!! preg_replace("/($query)/",'<span class="highlight" >$1</span>',str_limit(app(\App\Zwforum\Markdown\Markdown::class)->convertHtmlToMarkdown($topic->content),250)) !!}
                            </div>
                            <hr>
                        </div>
                @endforeach
                @else
                    <div class="empty-block">没有任何数据~~</div>
                @endif
            </div>
            <div style="padding-right: 15px;" class=" text-right remove-padding-horizontal pager-footer" >
                @if($topics->lastPage() == 1)
                    <div class="pagination">
                        <span style="color:#8b8a8a">已经是最后一页了</span>
                    </div>
                @else
                    {!! $topics->appends(Request::except('page', '_pjax'))->render() !!}
                @endif
            </div>
        </div>
    </div>
@endsection

@section("script")
<script>
</script>
@endsection()