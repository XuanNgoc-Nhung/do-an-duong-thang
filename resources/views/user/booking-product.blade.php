@extends('user.layouts.app')
@section('title')
    <title>Đặt sản phẩm</title>
@endsection
@section('content')
    <div id="user-home">
        <booking-product/>
    </div>
@endsection

@section("js_location")
    <script src="{{asset('js/booking-product.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
