<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-menu-user img-radius" src="{{!empty(auth()->user()->avatar)? url('/images').'/'.auth()->user()->avatar:url('/').'/cms/assets/images/avatar-4.jpg'}}"
                     alt="{{auth()->user()->name}}">
                <div class="user-details">
                    <p id="more-details">
                        <i class="feather icon-chevron-down m-r-10"></i>
                        {{auth()->user()->name}}
                    </p>
                </div>
            </div>
            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="{{route('admin.profile')}}">
                            <i class="feather icon-user"></i>پروفایل
                        </a>
                        <a href="{{route('admin.logout')}}">
                            <i class="feather icon-log-out"></i>خروج
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigation-label">لایه ها</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="active">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">داشبورد</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.music')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-music"></i></span>
                    <span class="pcoded-mtext">آهنگ ها</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('admin.posts')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-list"></i></span>
                    <span class="pcoded-mtext">پست ها</span>
                </a>
            </li>
        </ul>

    </div>
</nav>
