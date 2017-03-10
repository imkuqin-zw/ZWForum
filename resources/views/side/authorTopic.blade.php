<div class="panel panel-default corner-radius ">
    <div class="panel-heading text-center">
        <h3 class="panel-title">作者的其它话题</h3>
    </div>
    <div class="panel-body">
        <ul class="list ">
            <?php
                $sideAuthorTopics = \App\Model\Topic::where('user_id',$topic->user->id)
                    ->whereHas('category',function($q){
                        $q->where('is_blocked','no');
                    })
                    ->orderBy('reply_count','desc')->take(5)->get();
            ?>
            @foreach($sideAuthorTopics as $sideAuthorTopic)
                <li style="border-bottom: 1px solid #f2f2f2; padding-bottom: 5px;" data-toggle="tooltip"  data-original-title="{{$sideAuthorTopic->title}}">
                    <a  href="{{route('topic.show',$sideAuthorTopic->id)}}"  title="{{$sideAuthorTopic->title}}">
                        {{$sideAuthorTopic->title}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>