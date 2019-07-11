<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                <i class="feather icon-toggle-left"></i>
            </a>
            <a href="">
                <img class="img-fluid" src="{{url('/')}}/cms/assets/images/logo-5.png" alt="Theme-Logo" />
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                        <i class="full-screen feather icon-maximize"></i>
                    </a>
                </li>

            </ul>
            <ul class="nav-right">
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-bell"></i>
                            <span class="badge bg-c-red isf">5</span>
                        </div>
                        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <h6>اعلانات</h6>
                                <label class="label label-danger">جدید</label>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="img-radius" src="{{url('/')}}/cms/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                    <div class="media-body isf">
                                        <h5 class="notification-user">رضا ملکیان</h5>
                                        <p class="notification-msg">اعلام نمرات درس میکس رایانه ایی</p>
                                        <span class="notification-time">30 دقیقه پیش</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="img-radius" src="{{url('/')}}/cms/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="notification-user">مسعود درویشی</h5>
                                        <p class="notification-msg">امتحان درس هندسه محاسباتی</p>
                                        <span class="notification-time">1 روز قبل</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="img-radius" src="{{url('/')}}/cms/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="notification-user">مسعود درویشی</h5>
                                        <p class="notification-msg">امتحان درس هندسه محاسباتی</p>
                                        <span class="notification-time">1 روز قبل</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <span class="float-right">{{auth()->user()->name}}</span>
                            <i class="feather icon-chevron-down"></i>
                            <img src="{{!empty(auth()->user()->avatar)? url('/images').'/'.auth()->user()->avatar:url('/').'/cms/assets/images/avatar-4.jpg'}}" class="img-radius" alt="{{auth()->user()->name}}">
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="#">
                                    <i class="feather icon-user"></i> پروفایل
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.logout')}}">
                                    <i class="feather icon-log-out"></i> خروج
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
            