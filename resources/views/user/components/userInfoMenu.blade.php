<div class="panel panel-body text-center user-basic-nav ">
    <ul class="list-group">
        <a href="{{route('user.topicsList',$user->id)}}" class="@if($userMenu == 'topic') active @endif">
            <li class="list-group-item">
                <i class=" glyphicon glyphicon-th-list"></i>&nbsp;&nbsp;&nbsp;Ta 发布的话题</li>
        </a>
        <a href="{{route('user.repliesList',$user->id)}}" class="@if($userMenu == 'reply') active @endif">
            <li class="list-group-item">
                <i class="glyphicon glyphicon-comment"></i>&nbsp;&nbsp;&nbsp;Ta 发表的回复</li>
        </a>
        <a href="{{route('user.followerList',$user->id)}}" class="@if($userMenu == 'follower') active @endif">
            <li class="list-group-item">
                <i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;&nbsp;Ta 关注的用户</li>
        </a>
        <a  href="{{route('user.votesList',$user->id)}}" class="@if($userMenu == 'vote') active @endif">
            <li style="border-bottom: none !important;" class="list-group-item">
                <i class="glyphicon glyphicon-thumbs-up"></i>&nbsp;&nbsp;&nbsp;Ta 赞过的话题</li>
        </a>
    </ul>
</div>