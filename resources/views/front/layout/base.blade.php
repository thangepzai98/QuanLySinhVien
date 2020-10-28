<!DOCTYPE html>
<html class="no-js" lang="vi">
<!-- belle/home2-default.html   11 Nov 2019 12:22:28 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Thang Mobile</title>
<meta name="description" content="description">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('front/assets/images/logo_thangmobile.png')}}" />
<!-- Plugins CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/plugins.css') }}">
<!-- Bootstap CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
<!-- Main Style CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">
<style>
.invalid-feedback {
    display: block;
}

.grid-products .item {
    border: 1px solid #ebecec;
    margin-bottom: 0;
}

.productSlider .item {
    border: none;
}

#language {
    text-align: center !important;
    width: 132px;
}

#currencies li, #language li {
    padding: 7px 0px;
    border-bottom: none;
}
</style>
@yield('styles')
</head>
<body class="@yield('page_class')">

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
        xfbml            : true,
        version          : 'v6.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
    attribution=setup_tool
    page_id="111940230331719"
    theme_color="#ff5ca1">
</div>


<div id="pre-loader">
    <img src="{{ asset('front/assets/images/loader.gif') }}" alt="Loading..." />
</div>
<div class="pageWrapper">
	<!--Search Form Drawer-->
	<div class="search">
        <div class="search__form">
            <form class="search-bar__form" action="/search">
                <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                <input class="search__input" type="search" name="keyword" value="" placeholder="Tìm kiếm sản phẩm" aria-label="Search" autocomplete="off">
            </form>
            <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
        </div>
    </div>
    <!--End Search Form Drawer-->
    <!--Top Header-->
    <div class="top-header">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-10 col-sm-8 col-md-5 col-lg-4">
                    <p class="phone-no"><i class="anm anm-phone-s"></i> 0345419999</p>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                	<div class="text-center"><p class="top-header_middle-text">Freeship toàn quốc</p></div>
                </div>
                <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                	<span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                    <ul class="customer-links list-inline">
                        @if (!Auth::check())
                            <li><a href="/login">Đăng nhập</a></li>
                        @else
                            <div class="language-dropdown">
                                <span class="language-dd">{{Auth::user()->name}}</span>
                                <ul id="language" style="display: none;">
                                    <li class="">Thông tin cá nhân</li>
                                    <li class="">Quản lý đơn hàng</li>
                                    <li class="" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Đăng xuất</li>
                                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--End Top Header-->
    
    @include('front.layout.nav')
    
    <!--Body Content-->
    <div id="page-content">
        @yield('content')
    </div>
    <!--End Body Content-->
    
   @include('front.layout.footer')
    <!--Scoll Top-->
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    <!--End Scoll Top-->
    
    
     <!-- Including Jquery -->
     <script src="{{ asset('front/assets/js/vendor/jquery-3.3.1.min.js') }}"></script> 
     <script src="{{ asset('front/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
     <script src="{{ asset('front/assets/js/vendor/jquery.cookie.js') }}"></script>
     <script src="{{ asset('front/assets/js/vendor/wow.min.js') }}"></script>
     <!-- Including Javascript -->
     <script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('front/assets/js/plugins.js') }}"></script>
     <script src="{{ asset('front/assets/js/popper.min.js') }}"></script>
     <script src="{{ asset('front/assets/js/lazysizes.js') }}"></script>
     <script src="{{ asset('front/assets/js/main.js') }}"></script>
    @yield('scripts')
</div>
</body>
</html>