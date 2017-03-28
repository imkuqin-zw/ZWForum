<div class=" panel-body panel padding-sm user-basic-info">
    <div style="">
        <div class="media text-center">
            @if(Auth::check() && Auth::id() == $user->id)
            <a href="{{route('user.editPortrait',$user->id)}}" data-toggle="tooltip" data-original-title="修改头像" title="修改头像">
                <img class=" avatar-112 avatar img-thumbnail" src="{{asset('uploads/portraits').'/'}}{{($user->portrait_mid)?:'profile-pic_mid.png'}}">
            </a>
            @else
                <img class=" avatar-112 avatar img-thumbnail" src="{{asset('uploads/portraits').'/'}}{{($user->portrait_mid)?:'profile-pic_mid.png'}}">
            @endif
            <div class="media-body" style="padding-top: 5px;">
                <h3 class="media-heading">{{$user->name}}</h3>
                <div class="item"> {{$user->real_name}}</div>
                <div class="item"> 第 <span style="color:#aaa" >{{$user->id}}</span> 位会员</div>
                <div class="item number">
                    注册于 <span style="color:#aaa" data-toggle="tooltip"  data-original-title="{{$user->created_at}}" title="{{$user->created_at}}">{{$user->created_at->diffForHumans()}}</span>
                </div>
            </div>
        </div>

    </div>

    <hr>
    <div class="follow-info row">
        <div class="col-xs-4">
            <a class="counter" href="{{route('user.fansList',$user->id)}}">{{$user->follower_count}}</a>
            <a class="text" href="{{route('user.followerList',$user->id)}}">关注者</a>
        </div>
        <div class="col-xs-4">
            <a class="counter" href="{{route('user.topicsList',$user->id)}}">{{$topicCount}}</a>
            <a class="text" href="{{route('user.topicsList',$user->id)}}">话题</a>
        </div>
        <div class="col-xs-4">
            <a class="counter" href="{{route('user.excellencesList',$user->id)}}">{{$excellenceCount}}</a>
            <a class="text" href="{{route('user.excellencesList',$user->id)}}">精华</a>
        </div>
    </div>
    @if(Auth::check() && Auth::id() != $user->id)
        @if(\App\Model\Followers::where(['user_id'=>Auth::id(),'follower_id'=>$user->id])->count())
            <span class="text-white">
                <hr>
                <form action="{{route('follower.delete',$user->id)}}" method="post" >
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="follower_id" value="{{$user->id}}" >
                    <input class="btn btn-default btn-block" type="submit" value="取消关注"  >
                </form>
            </span>
        @else
            <span class="text-white">
                <hr>
                <form action="{{route('follower.create')}}" method="post" >
                    {{csrf_field()}}
                    <input type="hidden" name="follower_id" value="{{$user->id}}" >
                    <input class="btn btn-warning btn-block" type="submit" value="关注"  >
                </form>
            </span>
        @endif
    @endif

    @if( Auth::check() && Auth::user()->id == $user->id )
    <hr>
    <a class="btn btn-primary btn-block" href="{{route('user.edit',$user->id)}}" id="user-edit-button">
        <i class="fa fa-edit"></i> 编辑个人资料
    </a>
    @endif
</div>