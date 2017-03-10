<div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
        <h3 class="panel-title">作者：{{$topic->user->name}}</h3>
    </div>
    <div class="panel-body text-center topic-author-box">
        <a href="{{route('user.show',$topic->user->id)}}">
            <img src="{{asset('uploads/portraits/').'/'}}{{($topic->user->portrait_min)?:"profile-pic_min.png"}}" style="width:80px; height:80px;margin:5px;" class="img-thumbnail avatar">
        </a>
        <div class="media-body padding-top-sm">
            <div class="media-heading">
                <div class="role-label text-white">
                    <a class="label label-success role" href="#">创始人</a>
                </div>
                <span class="introduction">{{$topic->user->description}}</span>
            </div>
            <ul class="list-inline"></ul>
            <div class="clearfix"></div>
        </div>
        @if(Auth::check() && Auth::id() != $topic->user->id)
            @if(\App\Model\Followers::where(['user_id'=>Auth::id(),'follower_id'=>$topic->user->id])->count())
            <span class="text-white">
                <hr>
                <form action="{{route('follower.delete',$topic->user->id)}}" method="post" >
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="follower_id" value="{{$topic->user->id}}" >
                    <input class="btn btn-default btn-block" type="submit" value="取消关注"  >
                </form>
            </span>
            @else
            <span class="text-white">
                <hr>
                <form action="{{route('follower.create')}}" method="post" >
                    {{csrf_field()}}
                    <input type="hidden" name="follower_id" value="{{$topic->user->id}}" >
                    <input class="btn btn-warning btn-block" type="submit" value="关注"  >
                </form>
            </span>
            @endif
        @endif
    </div>
</div>