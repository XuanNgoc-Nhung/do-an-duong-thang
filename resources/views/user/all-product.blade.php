@extends('user.layouts.app')
@section('title')
    <title>Toàn bộ sản phẩm</title>
@endsection
@section('content')
    <div id="user-home">
        <all-products/>
    </div>
@endsection

@section("js_location")
    <script src="{{asset('js/all-products.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
