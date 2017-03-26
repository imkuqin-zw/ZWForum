@extends('layout.default')
@section('title',$user->name.'-关注列表')

@section('content')
    <div class="container border-color main-container">
        <div class="col-md-3">
            @include('user.components.userBaseInfo')
            @include('user.components.userInfoMenu')
        </div>
        <div class="col-md-9 ">

            <ol class="breadcrumb panel" style="border-color: #d9edf7; ">
                <li><a href="{{route('user.show',$user->id)}}">个人中心</a></li>
                <li class="active">Ta 的关注者</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($fans->total())
                        <ul class="list-group ">
                            @foreach($fans as $item)
                                <li class="list-group-item">
                                    <a href="{{route('user.show',$item->user_id)}}" title="{{$item->name}}">
                                        <img style="" class="img-thumbnail avatar-middle avatar avatar-small inline-block " src="{{asset('uploads/portraits').'/'}}{{($item->portrait_min)?:'profile-pic_min.png'}}">
                                        {{$item->name}}
                                    </a>
                                    @if($item->description)
                                    <span class="introduction">
                                         - {{$item->description}}
                                    </span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="pull-right">
                            @if($fans->lastPage() == 1)
                                <div class="pagination">
                                    <span style="color:#8b8a8a">已经是最后一页了</span>
                                </div>
                            @else
                                {!! $fans->render() !!}
                            @endif
                        </div>
                    @else
                        <div class="empty-block">没有任何数据~~</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection