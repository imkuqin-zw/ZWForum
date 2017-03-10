<div class="panel panel-default corner-radius ">
    <div class="panel-heading text-center">
        <h3 class="panel-title">分类下的其它话题</h3>
    </div>
    <div class="panel-body">
        <ul class="list ">
            <?php
                $sideCateTopics = \App\Model\Topic::where('category_id',$topic->category->id)
                    ->whereHas('category',function($q){
                        $q->where('is_blocked','no');
                    })
                    ->orderBy('reply_count','desc')->take(5)->get();
            ?>
            @foreach($sideCateTopics as $sideCateTopic)
                <li style="border-bottom: 1px solid #f2f2f2; padding-bottom: 5px;" data-toggle="tooltip"  data-original-title="{{$sideCateTopic->title}}">
                    <a  href="{{route('topic.show',$sideCateTopic->id)}}"  title="{{$sideCateTopic->title}}">
                        {{$sideCateTopic->title}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>