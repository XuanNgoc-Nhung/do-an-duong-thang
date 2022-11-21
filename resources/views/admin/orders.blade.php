@extends('admin.layouts.app')
@section('title')
    <title>Quản lý đơn hàng</title>
@endsection
@section('content')
    <div id="app">
        <don-hang/>
    </div>
@endsection

@section("js_location")
    <script src="{{asset('js/admin-quan-ly-don-hang.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
