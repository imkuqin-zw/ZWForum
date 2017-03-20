@extends('layout.default')
@section('title','修改话题')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/simplemde.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput-typeahead.css')}}">
    <style>

    </style>
@endsection

@section('content')
    <div class="container main-container">
        @include('layout.error')
        <div class="col-md-8">
            <form method="POST" action="{{route('topic.update',$topic->id)}}">
                <input name="_method" type="hidden" value="PATCH">
                {{csrf_field()}}
                <div class="form-group">
                    <select class="selectpicker form-control" name="category_id" id="category-select" required="require">
                        <option value="" disabled="" selected="">请选择分类</option>
                        @foreach ($categorys as $category)
                            <option @if($topic->category->id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" autocomplete=off id="topic-title" placeholder="请填写标题" name="title" type="text" value="{{$topic->title}}" required="require">
                </div>
                <textarea name="content" placeholder="请使用 Markdown 格式书写 ;-)，代码片段黏贴时请注意使用高亮语法。" id="topic-editable">{!! $topic->content  !!}</textarea>
                <div class="form-group">
                    <input class="form-control " data-provide="typeahead"  id="topic-tags" placeholder="请填写标签" name="tags" type="text" value="" />
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="修改" >
                </div>
            </form>
        </div>
        <div class="col-md-4 side-bar border-color">
            <div class="panel panel-default corner-radius help-box ">
                <div class="panel-heading text-center ">
                    <h3 class="panel-title">以下类型的信息会污染我们的社区</h3>
                </div>
                <div class="panel-body ">
                    <ul class="list">
                        <li data-toggle="tooltip" data-original-title="请传播美好的事物，这里拒绝低俗、诋毁、谩骂等相关信息" >请传播美好的事物，这里拒绝低俗、诋毁、谩骂等相关信息</li>
                        <li data-toggle="tooltip" data-original-title="尽量分享技术相关的话题，谢绝发布社会, 政治等相关新闻" >请尽量分享技术相关的话题，谢绝发布社会, 政治等相关新闻</li>
                        <li data-toggle="tooltip" data-original-title="这里绝对不讨论任何有关盗版软件、音乐、电影如何获得的问题" >这里绝对不讨论任何有关盗版软件、音乐、电影如何获得的问题</li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default corner-radius help-box">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">在高质量优秀社区的我们</h3>
                </div>
                <div class="panel-body">
                    <ul class="list">
                        <li>分享生活见闻, 分享知识</li>
                        <li>接触新技术, 讨论技术解决方案</li>
                        <li>为自己的创业项目找合伙人, 遇见志同道合的人</li>
                        <li>自发线下聚会, 加强社交</li>
                        <li>发现更好工作机会</li>
                        <li>甚至是开始另一个神奇的开源项目</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/simplemde.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/codemirror-4.inline-attachment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/typeahead.bundle.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-tagsinput.min.js')}}"></script>


    <script type="text/javascript" >
      $(document).ready(function() {
        $("[data-toggle='tooltip']").tooltip({
          container: "body"
        });
        var simplemde = new SimpleMDE({
          element: document.getElementById("topic-editable"),
          spellChecker: false,
          autosave: {
            enabled: true,
            delay: 1000,
            unique_id: "topic_content{{ isset($topic) ? $topic->id : '' }}",
          },
          forceSync: true
        });

        inlineAttachment.editors.codemirror4.attach(simplemde.codemirror, {
          uploadUrl: "{{route('topic.uploadImg')}}",
          extraParams: {
            '_token': "{{ csrf_token() }}",
          },
          onFileUploadResponse: function (xhr) {
            var result = JSON.parse(xhr.responseText),
              filename = result[this.settings.jsonFieldName];
            if (result && filename) {
              var newValue;
              if (typeof this.settings.urlText === 'function') {
                newValue = this.settings.urlText.call(this, filename, result);
              } else {
                newValue = this.settings.urlText.replace(this.filenameTag, filename);
              }
              var text = this.editor.getValue().replace(this.lastValue, newValue);
              this.editor.setValue(text);
              this.settings.onFileUploaded.call(this, filename);
            }
            return false;
          }
        });
        var tags = eval({!! $tags !!});
        var temp;
        temp = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: tags,
        });
        temp.initialize();
        $('#topic-tags').tagsinput({
          itemValue: 'id',
          itemText: 'name',
          valueKey: 'id',
          typeaheadjs: {
            display: 'name',
            source: temp.ttAdapter()
          }
        });
        @foreach($topic->tagJsons as $tagJson)
        $('#topic-tags').tagsinput('add', {!! $tagJson  !!});
        @endforeach
      });
    </script>
@endsection
