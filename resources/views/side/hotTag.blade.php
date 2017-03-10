<div class="panel panel-default corner-radius panel-active-users">
    <div class="panel-heading text-center">
        <h3 class="panel-title">热门标签</h3>
    </div>
    <div class="panel-body tag-badge">
        <?php $sideTags = \App\Model\Tag::get(); ?>
        @foreach($sideTags as $sideTag)
        <a href="{{route('tag.show',$sideTag->id)}}" title="{{$sideTag->name}}"><span class="badge">{{$sideTag->name}}</span></a>
        @endforeach
    </div>
</div>