@extends('admin.layouts.app')
@section('title')
    <title>Danh mục sản phẩm</title>
@endsection
@section('content')
    <div id="app">
        <danh-muc/>
    </div>
@endsection

@section("js_location")
    <script src="{{asset('js/admin-quan-ly-danh-muc.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
