@extends('user.layouts.app')
@section('title')
    <title>Danh sách đơn hàng</title>
@endsection
@section('content')
    <div id="user-home">
        <booking-list/>
    </div>
@endsection

@section("js_location")
    <script src="{{asset('js/booking-list.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
