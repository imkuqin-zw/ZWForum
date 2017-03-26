<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">ZWForum</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li @if(!isset($nav_category))class="active"@endif><a href="{{route('topic.index')}}">社区 <span class="sr-only">(current)</span></a></li>
                <?php $nav_cates = \App\Model\Category::where('is_blocked','no')->orderBy('order','desc')->get(); ?>
                @foreach($nav_cates as $nav_cate)
                <li @if(isset($nav_category) && $nav_cate->id == $nav_category) class="active" @endif ><a href="{{route('category.show',$nav_cate->id)}}">{{$nav_cate->name}}</a></li>
                @endforeach
            </ul>
            <form action="{{ route('search') }}" class="navbar-form navbar-left">
                <input type="text" name="wd" class="form-control" placeholder="搜索" value="@if(isset($query)){{ $query }}@endif">
            </form>
            @if(!Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('login')}}">登录</a></li>
                <li><a href="{{route('register')}}">注册</a></li>
            </ul>
            @else
            <?php
                $topicNotificationsCount = app(\App\Repositories\TopicNotificationRepository::class)->getCount(Auth::user()->id);
                $replyNotificationsCount = app(\App\Repositories\ReplyNotificationRepository::class)->getCount(Auth::user()->id);
                $notificationsCount = (int)$topicNotificationsCount + (int)$replyNotificationsCount;
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('topic.create')}}"><i class="glyphicon glyphicon-plus" ></i></a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >
                        通知 <span class="badge" @if($notificationsCount)style="background-color: #d15b47" @endif >{{  $notificationsCount }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('user.notifications') }}" >关注的话题 <span class="badge" @if($topicNotificationsCount)style="background-color: #d15b47" @endif >{{  $topicNotificationsCount }}</span></a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ route('user.mentions') }}" >@提及到我 <span class="badge" @if($replyNotificationsCount)style="background-color: #d15b47" @endif >{{  $replyNotificationsCount }}</span></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="avatar-topnav" alt="{{Auth::User()->name}}" src="{{(Auth::User()->portrait_min)? (asset('uploads/portraits/'.Auth::User()->portrait_min)):asset('uploads/portraits/profile-pic_min.png')}}"> {{Auth::User()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('user.show',Auth::User()->id)}}">个人中心</a></li>
                        <li><a href="{{route('user.edit',Auth::User()->id)}}">编辑资料</a></li>
                        @if(Auth::User()->is_admin == 'yes')
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('admin.index')}}">后台管理</a></li>
                        @endif
                        <li role="separator" class="divider"></li>
                        <li><form id="logoutForm" method="post" action="{{route('logout')}}">{{csrf_field()}}</form><a onclick="document.getElementById('logoutForm').submit();return false" >退出</a></li>
                    </ul>
                </li>
            </ul>
            @endif
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>