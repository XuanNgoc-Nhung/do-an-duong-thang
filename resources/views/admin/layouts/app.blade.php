
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    @yield('title')
    @include('admin.layouts.css')

</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Header -->
    @include('admin.layouts.header')
    <!-- /Header -->

    <!-- Sidebar -->
    @include('admin.layouts.menu')
    <!-- /Sidebar -->
    <div class="page-wrapper">
        <div class="content container-fluid pb-0">
            @yield('content')
        </div>
    </div>
</div>
@include('admin.layouts.js')
@yield('js_location')
</body>
</html>
