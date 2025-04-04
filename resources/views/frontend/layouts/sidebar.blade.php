@php 

use App\Models\Log;
$user = Illuminate\Support\Facades\Auth::user(); 

@endphp


<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <div id="addLoader"></div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start   -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper">
                        <a href="{{ url('/') }}"> <img class="img-fluid for-light"
                                src="{{ isset($settings['logo_light']) ? asset($settings['logo_light']->value) : '' }}" alt=""><img class="img-fluid for-dark"
                                src="{{ isset($settings['logo_dark']) ? asset($settings['logo_dark']->value) : '' }}" alt=""></a>

                                
                    </div>
                    <div class="toggle-sidebar">
                        <svg class="sidebar-toggle">
                            <use href="{{ asset('frontend/images/icon-sprite.svg#stroke-animation')}}"></use>
                        </svg>
                    </div>
                </div>
                <form class="col-sm-4 form-inline search-full d-none d-xl-block" action="#" method="get">
                    <div class="form-group">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative">
                                <input class="demo-input Typeahead-input form-control-plaintext w-100 rounded" type="text"
                                    placeholder="Tìm kiếm file ..." name="q" title="" autofocus="">
                                <svg class="search-bg svg-color">
                                    <use href="{{ asset('frontend/images/icon-sprite.svg#search')}}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="nav-right col-xl-8 col-lg-12 col-auto pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li class="serchinput">
                            <div class="serchbox">
                                <svg>
                                    <use href="{{ asset('frontend/images/icon-sprite.svg#search')}}"></use>
                                </svg>
                            </div>
                            <div class="form-group search-form">
                                <input type="text" placeholder="Tìm kiếm...">
                            </div>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <svg>
                                    <use href="{{ asset('frontend/images/icon-sprite.svg#Bell')}}"></use>
                                </svg>
                            </div>
                            <div class="onhover-show-div notification-dropdown">
                                <h6 class="f-18 mb-0 dropdown-title">Thông báo</h6>
                                <div class="notification-card">
                                    <ul>
                                        @foreach (Log::where('user_id', $user->id)->limit(5)->get() as $log)
                                        <li>
                                            <div class="user-notification">
                                                <div><img src="{{ $user->avatar }}" alt="avatar"></div>
                                                <div class="user-description">
                                                    <a href="letter-box.html">
                                                        <h4>{{$log->action}}</h4>
                                                    </a><span>{{ $log->created_at }}</span>
                                                </div>
                                            </div>
                                            {{-- <div class="notification-btn">
                                                <button class="btn btn-pill btn-primary" type="button"
                                                    title="btn btn-pill btn-primary">Accpet</button>
                                                <button class="btn btn-pill btn-secondary" type="button"
                                                    title="btn btn-pill btn-primary">Decline</button>
                                            </div> --}}
                                        </li>
                                        @endforeach
                                      
                                        <li> <a class="f-w-700" href="{{url('notification')}}">Xem tất cả</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="mode">
                                <svg class="for-dark">
                                    <use href="{{ asset('frontend/images/icon-sprite.svg#moon')}}"></use>
                                </svg>
                                <svg class="for-light">
                                    <use href="{{ asset('frontend/images/icon-sprite.svg#Sun')}}"></use>
                                </svg>
                            </div>
                        </li>
                        <!-- <li class="language-nav">
                            <div class="translate_wrapper">
                                <div class="current_lang">
                                    <div class="lang"><i class="flag-icon flag-icon-vn"></i><span
                                            class="lang-txt box-col-none">Tiếng Việt </span></div>
                                </div>
                                <div class="more_lang">
                                    <div class="lang selected" data-value="de"><i
                                            class="flag-icon flag-icon-vn"></i><span class="lang-txt">Tiếng Việt</span>
                                    </div>
                                    <div class="lang " data-value="en"><i class="flag-icon flag-icon-us"></i><span
                                            class="lang-txt">Tiếng Anh<span></span></span>
                                    </div>

                                </div>
                            </div>
                        </li> -->
                        @auth
                        <li class="profile-nav onhover-dropdown pe-0 py-0">
                            <div class="d-flex align-items-center profile-media"><img class="b-r-25" width="40" id="sidebar-avatar"
                                src="{{ $user->avatar ? asset($user->avatar) : 'https://cdn-icons-png.flaticon.com/128/9386/9386837.png' }}" 
                                alt="Avatar">
                                <div class="flex-grow-1 user"><span>{{ Auth::user()->name }}</span>
                                    <p class="mb-0 font-nunito">
                                        {{ Auth::user()->rule }}
                                        <svg>
                                            <use
                                                href="{{ asset('frontend/images/icon-sprite.svg#header-arrow-down') }}">
                                            </use>
                                        </svg>
                                    </p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="{{ url('profile') }}"><i data-feather="user"></i><span>Tài khoản </span></a>
                                </li>
                                <li><a href="{{ url('/upgrade') }}"><i data-feather="credit-card"></i><span>Nâng cấp</span></a></li>
                                <li><a href="{{ url('/notification') }}"><i data-feather="mail"></i><span>Thông báo</span></a></li>
                                <li><a href="{{ url('/file') }}"><i data-feather="file-text"></i><span>File của tôi</span></a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button style="outline: none; background:none; border:none;" type="submit">
                                            <i data-feather="log-in"></i><span>Đăng xuất</span></button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endauth
                        @guest
                        <li class="profile-nav onhover-dropdown pe-0 py-0">
                            <a class="btn btn-square btn-primary" style="border-radius: 3px"
                                href="{{ route('login') }}">Đăng Nhập</a>
                        </li>
                        @endguest
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">
                        <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                        <div class="ProfileCard-details">
                            <div class="ProfileCard-realName"></div>
                        </div>
                    </div>
                </script>
                <script class="empty-template" type="text/x-handlebars-template">
                    <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
                </script>
            </div>
        </div>
        <!-- Page Header Ends -->
        <!-- Page body Start -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper" data-layout="stroke-svg">
                <div>
                    <div class="logo-wrapper">
                        <a href="{{ url('/') }}"> <img class="img-fluid for-light"
                                src="{{ isset($settings['logo_light']->value) ? asset($settings['logo_light']->value) : '' }}" alt=""><img class="img-fluid for-dark"
                                src="{{ asset('frontend/images/logo_dark.png') }}" alt=""></a>
                        <div class="toggle-sidebar">
                            <svg class="sidebar-toggle">
                                <use href="{{ asset('frontend/images/icon-sprite.svg#toggle-icon')}}"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="logo-icon-wrapper">
                        <a href="{{ url('/') }}"><img class="img-fluid"
                                src="{{ asset('frontend/images/logo-icon.png') }}" alt=""></a>
                    </div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn">
                                    <a href="{{ url('/') }}"><img class="img-fluid"
                                            src="{{ asset('frontend/images/logo-icon.png') }}" alt=""></a>
                                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                            aria-hidden="true"></i></div>
                                </li>
                                <li class="pin-title sidebar-main-title">
                                    <div>
                                        <h6>Pinned</h6>
                                    </div>
                                </li>
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="lan-1">General</h6>
                                    </div>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('/') }}">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#stroke-home')}}"></use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#fill-home')}}"></use>
                                        </svg><span class="lan-3">Trang chủ </span></a>

                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('/file') }}">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#stroke-layout')}}">
                                            </use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#fill-layout')}}"></use>
                                        </svg><span class="lan-3">File của tôi </span></a>

                                </li>
                                {{-- <li class="sidebar-list"> 
                                    <a class="sidebar-link sidebar-title" href="#">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#stroke-layout')}}">
                                            </use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#fill-layout')}}"></use>
                                        </svg><span class="lan-7">File của tôi</span></a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ url('/file') }}">Tất cả file</a></li>
                                    </ul>
                                </li> --}}
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="lan-8">Applications</h6>
                                    </div>
                                </li>
<!-- 
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('shared') }}">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#stroke-user')}}"></use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#fill-bookmark')}}">
                                            </use>
                                        </svg><span>Được chia sẻ </span></a>
                                </li> -->

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('upgrade') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-icon feather feather-upload-cloud"><polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>

                                        <svg class="fill-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#fill-icons')}}"></use>
                                        </svg><span>Nâng cấp tài khoản</span></a>

                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('recent') }}">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#stroke-maps')}}"></use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#fill-maps')}}"></use>
                                        </svg><span>Gần đây</span></a>

                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('trash') }}">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#trash')}}"></use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('frontend/images/icon-sprite.svg#fill-icons')}}"></use>
                                        </svg><span>Thùng rác</span></a>

                                </li>

                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->


            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-xl-4 col-sm-7 box-col-3">
                                <h3>@yield('title')</h3>
                            </div>
                            <div class="col-5 d-none d-xl-block">
                                <!-- Page Sub Header Start-->
                                <div class="left-header main-sub-header p-0">
                                    <div class="left-menu-header">
                                        <ul class="header-left">
                                          
                                        <li class=""><a class="f-w-700" href="{{ url('/file') }}"><span class="f-w-700">Quản lý file</span></a>  
                                          
                                            <li class=""><a class="f-w-700" href="{{ url('/upgrade') }}"><span class="f-w-700">Nâng cấp tài
                                                        khoản</span></a>
                                            <li class=""><a class="f-w-700" href="{{ url('/trash') }}"><span class="f-w-700">Thùng
                                                        rác</span></a>

                                            </li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-3 col-sm-5 box-col-4 rounded">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}">
                                            <svg class="stroke-icon">
                                                <use href="{{ asset('frontend/images/icon-sprite.svg#stroke-home')}}">
                                                </use>
                                            </svg>
                                        </a>
                                    </li>
                                    <!-- <li class="breadcrumb-item">Trang chủ</li> -->
                                    <!-- <li class="breadcrumb-item active"></li> -->
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>