<header class="header header-trans">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
            </a>
            <a href="{{route('user.home')}}" class="navbar-brand logo">
                <img src="assets/img/logo.png" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="index.html" class="menu-logo">
                    <img src="assets/img/logo.png" class="img-fluid" alt="Logo">
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">
                <li class="{{ Request::routeIs('user.home') ? 'active' : '' }}">
                    <a href="{{route('user.home')}}">Trang chủ</a>
                </li>
                <li class="{{ Request::routeIs('user.about') ? 'active' : '' }}"><a href="{{route('user.about')}}">Về
                        chúng tôi</a></li>
                <li class="{{ Request::routeIs('user.contact') ? 'active' : '' }}"><a href="{{route('user.contact')}}">Liên
                        hệ</a></li>
                <li class="{{ Request::routeIs('user.allProduct') ? 'active' : '' }}"><a
                        href="{{route('user.allProduct')}}">Sản phẩm</a></li>
                <li class="{{ Request::routeIs('user.listBooking') ? 'active' : '' }}"><a
                        href="{{route('user.listBooking')}}">Đơn hàng</a></li>
                <li>
                    <div class="">
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="Nhập từ khoá" >
                            <span class="input-group-text" id="basic-addon2">Tìm kiếm</span>
                        </div>
                    </div>
                </li>
                <li class="login-link">
                    <a href="login.html">Login / Signup</a>
                </li>
            </ul>
        </div>
        <ul class="nav header-navbar-rht">
            <li class="nav-item contact-item">
                <div class="header-contact-img">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="header-contact-detail">
                    <p class="contact-info-header">Liên hệ: 0332882442</p>
                </div>
            </li>
            <li class="nav-item">
            @if(Auth::check())
                <li><i class="fa fa-user"></i> {{Auth::user()->name}}</li>
                <li><a href="{{route('postLogout')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                            <path fill-rule="evenodd"
                                  d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                        </svg>
                        Đăng xuất </a></li>
            @else
                <li><a href="{{route('login')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                            <path fill-rule="evenodd"
                                  d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                        </svg>
                        Đăng nhập
                    </a>
                </li>
                @endif
                </li>
        </ul>
    </nav>
</header>
