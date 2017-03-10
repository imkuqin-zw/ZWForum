<div class="panel panel-default corner-radius panel-hot-topics">
    <div class="panel-heading text-center">
        <h3 class="panel-title">热门话题</h3>
    </div>
    <div class="panel-body">
        <ul class="list ">
            <?php $sideHotTopics = \App\Model\Topic::orderBy('view_count','desc')->take(5)->get(); ?>
            @foreach($sideHotTopics as $sideHotTopic)
            <li style="border-bottom: 1px solid #f2f2f2; padding-bottom: 5px;" data-toggle="tooltip"  data-original-title="{{$sideHotTopic->title}}">
                <a  href="{{route('topic.show',$sideHotTopic->id)}}"  title="{{$sideHotTopic->title}}">
                    {{$sideHotTopic->title}}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>