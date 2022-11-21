@extends('admin.layouts.app')
@section('title')
    <title>Quản lý sản phẩm</title>
@endsection
@section('content')
    <div id="app">
        <san-pham/>
    </div>
@endsection

@section("js_location")
    <script src="{{asset('js/admin-quan-ly-san-pham.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
