@extends('user.layouts.app')
@section('title')
    <title>Chi tiết sản phẩm</title>
@endsection
@section('content')
    <div id="user-home">
        <detail-product/>
    </div>
@endsection

@section("js_location")
    <script src="{{asset('js/detail-product.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
