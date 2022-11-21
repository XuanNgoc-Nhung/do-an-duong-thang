
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    @yield('title')
   @include('user.layouts.css')

</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper" id="app">

    <!-- Header -->
    @include('user.layouts.header')
    <!-- /Header -->
    @yield('content')
    @include('user.layouts.footer')
    <!-- /Footer -->

</div>
<!-- /Main Wrapper -->
@include('user.layouts.js')
@yield('js_location')
</body>
</html>
