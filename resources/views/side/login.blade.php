<div class="panel panel-default corner-radius text-center" >
    <div class="side-login panel-body">
        @if(!Auth::check())
            <a href="{{route('login')}}">登 录</a>
        @else
            <a href="{{route('topic.create')}}">发表主题</a>
        @endif
    </div>
</div>