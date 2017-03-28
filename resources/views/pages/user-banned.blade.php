@extends('layout.default')
@section('title','用户被禁用')
@section('styles')
@endsection
@section('content')
    <div class="container main-container border-color" >
        <div class="row">
            <div class="col-md-6 col-md-offset-3 floating-box">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">提示</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-warning">
                            对不起，你的账号已被禁用！
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
<script>
</script>
@endsection()