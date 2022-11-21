
<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a href="{{route('user.home')}}" class="logo">
            <img src="ad/assets/img/logo.png" alt="Logo">
        </a>
        <a href="{{route('user.home')}}" class="logo logo-small">
            <img src="ad/assets/img/logo-small.png" alt="Logo" width="30" height="30">
        </a>
        <a href="" id="toggle_btn">
            <i class="feather-chevrons-left"></i>
        </a>
    </div>
    <!-- /Logo -->
    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->

    <!-- Header Menu -->
    <ul class="nav nav-tabs user-menu">
        <!-- Flag -->
        <li class="nav-item">
            <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
                <i class="feather-sun light-mode"></i><i class="feather-moon dark-mode"></i>
            </a>
        </li>
        <!-- /Flag -->


        <!-- User Menu -->
        <li class="nav-item dropdown main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<span class="user-img">
								<img src="ad/assets/img/profiles/avatar-01.jpg" alt="">
								<span class="status online"></span>
							</span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="ad/assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>Robert Haddin</h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>
                </div>
                <a class="dropdown-item" href="{{route('logout')}}"><i class="feather-log-out me-1"></i> Đăng xuất</a>
            </div>
        </li>
        <!-- /User Menu -->

    </ul>
    <!-- /Header Menu -->

</div>
