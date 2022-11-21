<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Menu</span></li>
                <li class="{{ Request::routeIs('admin.getHome') ? 'active' : '' }}">
                    <a href="{{route('admin.getHome')}}"><i class="feather-grid"></i> <span>Tổng quan</span></a>
                </li>
                <li class="{{ Request::routeIs('admin.getCate') ? 'active' : '' }}">
                    <a href="{{route('admin.getCate')}}"><i class="feather-calendar"></i> <span>Danh mục</span></a>
                </li>
                <li class="{{ Request::routeIs('admin.getProduct') ? 'active' : '' }}">
                    <a href="{{route('admin.getProduct')}}"><i class="feather-calendar"></i> <span>Sản phẩm</span></a>
                </li>
                <li class="{{ Request::routeIs('admin.getOrder') ? 'active' : '' }}">
                    <a href="{{route('admin.getOrder')}}"><i class="feather-calendar"></i> <span>Đơn hàng</span></a>
                </li>
                <li class="{{ Request::routeIs('admin.getUser') ? 'active' : '' }}">
                    <a href="{{route('admin.getUser')}}"><i class="feather-calendar"></i> <span>Người dùng</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
