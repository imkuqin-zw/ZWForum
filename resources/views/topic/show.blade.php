@extends('layout.default')
@section('title',$topic->title)
@section('styles')
    <link rel="stylesheet" href="{{asset('css/markdown.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/highline.css')}}">--}}

    <style>

    </style>
@endsection
@section('content')
    <div class="container main-container">
        @include('layout.error')
        <div class="col-md-9 topics-show ">
            <div class="topic panel panel-default border-color" style="border-color: #d9edf7;">
                <div class="infos panel-heading">
                    <h1 class="panel-title topic-title">{{$topic->title}}</h1>
                    <div class="meta inline-block">
                        <a data-toggle="tooltip" data-original-title="分类" href="{{route('category.show',$topic->category->id)}}" class="remove-padding-left">
                            <i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>&nbsp;&nbsp;{{$topic->category->name}}
                        </a>
                        <span>
                            ⋅
                            <a data-toggle="tooltip" data-original-title="作者" href="{{route('user.show',$topic->user->id)}}">{{$topic->user->name}} </a>
                            ⋅ 发布于
                        </span>
                        <abbr title="" data-toggle="tooltip" data-original-title="{{$topic->created_at}}">{{ date_former($topic->created_at)}}</abbr>
                        <span>⋅ 阅读 {{$topic->view_count}} ⋅ 赞 <span id="vote_count">{{$topic->vote_count}}</span>
                            @if($isVoted === null)
                            @else
                                <a onclick="voteClick({{$topic->id}},this)" href="javascript:void(0)">
                                    <i class="glyphicon @if($isVoted) glyphicon-thumbs-down @else glyphicon-thumbs-up @endif"></i>
                                </a>
                            @endif
                        </span>
                        @if(Auth::check() && Auth::user()->id == $topic->user->id)
                        <span class="pull-right">
                            <a data-toggle="tooltip" data-original-title="修改" title="修改" href="{{route('topic.edit',$topic->id)}}"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-toggle="modal"  data-target="#delDialog" href="javascript:void(0)" onclick="setDelModelUrl('{{route('topic.delete',$topic->id)}}')" ><i class="glyphicon glyphicon-trash"></i></a>
                        </span>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="content-body entry-content panel-body ">

                    <div class="markdown-body" id="emojify">
                        {!!$topic->content!!}
                    </div>
                    @if($topic->is_excellent == 'yes')
                    <div data-lang-excellent="本帖已被设为精华帖！" data-lang-wiki="本帖已被设为社区 Wiki！" class="ribbon-container">
                        <div class="ribbon">
                            <div class="ribbon-excellent">
                                <i class="glyphicon glyphicon-fire"></i> 本帖已被设为精华帖！
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="panel-footer">
                    <div >
                        标签：
                        @if($tags)
                            @foreach($tags as $v)
                            <a href="{{route('tag.show',$v['id'])}}" title="{{$v['name']}}"><span class="badge">{{$v['name']}}</span></a>
                            @endforeach
                        @else
                            无
                        @endif
                    </div>
                        <div class="clearfix"></div>
                </div>
            </div>
            <div class="replies panel panel-default list-panel replies-index " style="border-color: #d9edf7;">
                <div class="panel-heading">
                    <div class="total">回复数量: <b>{{$topic->reply_count}}</b> </div>
                </div>
                <div class="panel-body">
                    @if(count($replies))
                    <ul class="list-group row">
                        @foreach($replies as $key => $reply)
                        <li class="list-group-item media" style="margin-top: 0px;">
                            <div class="avatar avatar-container pull-left">
                                <a href="{{route('user.show',$reply->user->id)}}">
                                    <img class="media-object img-thumbnail avatar avatar-middle" alt="{{$reply->user->name}}" src="{{asset('uploads/portraits').'/'}}{{($reply->user->portrait_min)?:"profile-pic_min.png"}}" style="width:55px;height:55px;">
                                </a>
                            </div>
                            <div class="infos">
                                <div class="media-heading">
                                    <a href="{{route('user.show',$reply->user->id)}}" title="{{$reply->user->name}}" class="remove-padding-left author">
                                        {{$reply->user->name}}
                                    </a>
                                    <span class="introduction"> {{$reply->user->description}}</span>
                                    <span class="operate pull-right">
                                        <a style="color: #337ab7" href="javascript:void(0)" onclick="replyOne('{{$reply->user->name}}')" title="回复 TimJuly">回复</a>
                                        @if(Auth::check() && Auth::user()->id == $reply->user->id)
                                            <a style="color: #337ab7" data-toggle="modal"  data-target="#delDialog" href="javascript:void(0)" onclick="setDelModelUrl('{{route('reply.delete',$reply->id)}}')" title="删除">删除</a>
                                        @endif
                                    </span>
                                    <div class="meta">
                                        <a name="reply{{$reply->id}}" id="reply{{$reply->id}}" class="anchor" href="#reply{{$reply->id}}" aria-hidden="true">#{{$key+1}}</a>
                                        <span> ⋅  </span>
                                        <abbr data-toggle="tooltip" data-original-title="{{$reply->created_at}}">{{date_former($reply->created_at)}}</abbr>
                                    </div>
                                </div>
                                <div class="media-body markdown-reply content-body">
                                    <p>{!! $reply->content !!}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div id="replies-empty-block" class="empty-block hide">暂无评论~~</div>
                    @endif
                </div>
            </div>
            <div class="reply-box form box-block" >
                @if(Auth::check())
                <form action="{{route('reply.create')}}" method="post" >
                    {{csrf_field()}}
                    <input type="hidden" name="topic_id" value="{{$topic->id}}" />
                    <div class="form-group">
                        <textarea id="reply_content" class="form-control" rows="5" placeholder="请使用 Markdown 格式书写 ;-)，代码片段黏贴时请注意使用高亮语法。"  name="content" cols="50">{{old('content')}}</textarea>
                    </div>
                    <div class="form-group">
                        <div style="margin: 0 2px;" class="row" >
                            <button class="btn btn-primary col-xs-5 col-sm-5 col-md-3" type="submit" />提交</button>
                            <button onclick="displayReply();" type="button" class="btn btn-info pull-right col-xs-5 col-sm-5 col-md-3" data-toggle="modal" data-target="#replyModal" >查看</button>
                        </div>
                    </div>
                </form>
                @else
                    <div  class="panel panel-body" style="border:1px solid #d9edf7;" >
                        <a id="reply_content" href="#" ></a>
                        <span>请先登录再评论 <a  class="btn btn-warning" href="{{route('login')}}">登录</a> </span>
                    </div>
                @endif
            </div>
            <div class="modal fade bs-example-modal-lg" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">评论展示</h4>
                        </div>
                        <div class="modal-body markdown-reply"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 side-bar border-color">
            @include('side.topicAuthor')
            @include('side.authorTopic')
            @include('side.categoryTopic')
            @include('side.hotTopic')
        </div>
    </div>

    <div class="modal fade bs-example-modal-sm" id="delDialog" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <div class="modal-body">
                    <p>确认删除吗？</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="">
                        <input name="_method" type="hidden" value="DELETE">
                        {{csrf_field()}}
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">确定</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/simplemde.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/emoji.js')}}" ></script>
<script type="text/javascript" src="{{asset('js/jquery.textcomplete.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('js/autosize.js')}}"></script>
<script type="text/javascript" src="{{asset('js/markdown.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.inline-attachment.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('js/highlight.pack.js')}}"></script>--}}
<script type="text/javascript" >
  $(function () {
//    hljs.initHighlightingOnLoad();
    autosize($('textarea'));
    $('textarea').textcomplete([
      { // emoji strategy
        match: /\B:([\-+\w]*)$/,
        search: function (term, callback) {
          callback($.map(emojies, function (emoji) {
            return emoji.indexOf(term) === 0 ? emoji : null;
          }));
        },
        template: function (value) {
          return '<img src="{{asset('/images/emoji/')}}' +'/'+ value + '.png"></img>' + value;
        },
        replace: function (value) {
          return ':' + value + ': ';
        },
        index: 1,
        maxCount: 5
      }
    ]);
    $('textarea').textcomplete([
      {
        mentions: eval({!! $user !!}),
        match: /@(\w*)$/,
        search: function (term, callback) {
          callback($.map(this.mentions, function (mention) {
            return mention.indexOf(term) === 0 ? mention : null;
          }));
        },
        replace: function (mention) {
          return '@' + mention + ' ';
        },
        index: 1,
        maxCount: 5
      }
    ]);
    $('textarea').inlineattachment({
      uploadUrl: "{{route('topic.uploadImg')}}",
      extraParams: {
        '_token': "{{ csrf_token() }}",
      }
    });
  });
  
  function displayReply() {
    var reply =  $('textarea').val();
    reply = markdown.toHTML(reply);
    console.log(reply);
    reply = reply.replace(/:([\-+\w]*):/g,"<img class='emoji' alt='$1' src='{{asset('/images/emoji/')}}/$1.png' />");
    reply = reply.replace(/<code>/g,"<pre><code class='language-php'>");
    reply = reply.replace(/<\\code>/g,"</code></pre>");
    $('#replyModal .modal-body').html(reply);
  }

  function replyOne(username){
    var replyContent = $("#reply_content");
    var oldContent = replyContent.val();
    var prefix = "@" + username + " ";
    var newContent = ''
    if(oldContent.length > 0){
      if (oldContent != prefix) {
        newContent = oldContent + "\n" + prefix;
      }
    } else {
      newContent = prefix
    }
    replyContent.focus();
    replyContent.val(newContent);
    moveEnd($("#reply_content"));
  }

  var moveEnd = function(obj){
    obj.focus();
    var len = obj.value === undefined ? 0 : obj.value.length;
    if (document.selection) {
      var sel = obj.createTextRange();
      sel.moveStart('character',len);
      sel.collapse();
      sel.select();
    } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
      obj.selectionStart = obj.selectionEnd = len;
    }
  }

  function voteClick(id,e) {
    $.ajax({
      type:'post',
      url: "{{route('topic.vote')}}",
      data: {'topic_id':id, '_token': "{{ csrf_token() }}"},
      success: function(){
        if($(e).children("i").hasClass('glyphicon-thumbs-up')){
            $('#vote_count').text(parseInt($('#vote_count').text())+1);
            $(e).children("i").attr('class','glyphicon glyphicon-thumbs-down')
        }
        else{
            $('#vote_count').text(parseInt($('#vote_count').text())-1);
            $(e).children("i").attr('class','glyphicon glyphicon-thumbs-up')
        }
      }
    });
  }

  function setDelModelUrl(url) {
    $('#delDialog form').attr('action',url);
  }

</script>
@endsection