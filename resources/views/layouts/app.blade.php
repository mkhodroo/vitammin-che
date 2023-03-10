<!DOCTYPE html>
<html lang="en" dir="rtl"><!-- sherad by mellatweb.com -->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')" / >
    <meta name="description" content="@yield('description')" / >

    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('public/store/assets/img/logo-ico.png') }}">
    <link rel="shortcut icon" href="{{ url('public/store/assets/img/logo-ico.png') }}">

    <!-- CSS Global -->
    <link href="{{ url('public/store/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/store/assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/store/assets/plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ url('public/store/assets/plugins/prettyphoto/css/prettyPhoto.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ url('public/store/assets/plugins/owl-carousel2/assets/owl.carousel.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ url('public/store/assets/plugins/owl-carousel2/assets/owl.theme.default.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ url('public/store/assets/plugins/animate/animate.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ url('public/dashboard/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/store/assets/css/bootstrap-theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/store/assets/css/custom-css.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/store/assets/css/rtl.css') }}" rel="stylesheet" type="text/css" />


    <!-- Theme CSS -->
    <link href="{{ url('public/store/assets/css/theme.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" type="text/css" media="screen" href="{{ url('public/store/assets/list-scroller/als_style.css') }}" /> --}}

    <!-- Head Libs -->
    {{-- <script src="{{ url('public/store/assets/plugins/modernizr.custom.js') }}"></script> --}}

    <script src="{{ url('public/store/assets/plugins/jquery/jquery-1.11.1.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ url('public/store/assets/list-scroller/jquery.als-2.1.min.js') }}" ></script> --}}
    <script> !function (t, e, n) { t.yektanetAnalyticsObject = n, t[n] = t[n] || function () { t[n].q.push(arguments) }, t[n].q = t[n].q || []; var a = new Date, r = a.getFullYear().toString() + "0" + a.getMonth() + "0" + a.getDate() + "0" + a.getHours(), c = e.getElementsByTagName("script")[0], s = e.createElement("script"); s.id = "ua-script-9DqBY2ni"; s.dataset.analyticsobject = n; s.async = 1; s.type = "text/javascript"; s.src = "https://cdn.yektanet.com/rg_woebegone/scripts_v3/9DqBY2ni/rg.complete.js?v=" + r, c.parentNode.insertBefore(s, c) }(window, document, "yektanet"); </script>
    <link  rel="stylesheet"  href="{{ url('public/swiperjs/swiper-bundle.min.css') }}" />

    <script src="{{ url('public/swiperjs/swiper-bundle.min.js') }}"></script>



    

</head>
<body id="home" class="wide">
<!-- PRELOADER -->
<div id="preloader">
    <div id="preloader-status">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
        <div id="preloader-title">?????????? ????????????</div>
    </div>
</div>
<!-- /PRELOADER -->

<!-- WRAPPER -->
<div class="wrapper">

    <!-- Popup: Shopping cart items -->
    @include('layouts.cart-item')
    <!-- /Popup: Shopping cart items -->

    <!-- Header top bar -->
    @include('store.profile.modal')
    @include('store.auth.login')
    @include('store.auth.register')
    @include('layouts.alert')
    @include('layouts.modal')
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-right">
                <ul class="list-inline" id="login-info">
                    <script>
                        $.get(`{{ route('get-user-info') }}`, function(data){
                            if(data){
                                $('#login-info').append(`<li class="icon-user" onclick="open_profile_modal()" style="cursor: pointer"><img src="{{ url('public/store/assets/img/icon-1.png') }}" alt=""/><span>${data.name}</span></li>`)
                                $('#login-info').append(`<li class="icon-form" onclick="logout()" style="cursor: pointer"><img src="{{ url('public/store/assets/img/icon-2.png') }}" alt=""/> <span class="colored">????????</span></span></li>`);
                            }else{
                                $('#login-info').append(`<li class="icon-user" onclick="open_login_modal()" style="cursor: pointer"><img src="{{ url('public/store/assets/img/icon-1.png') }}" alt=""/> <span>????????</span></li>`);
                                $('#login-info').append(`<li class="icon-form" onclick="open_register_modal()" style="cursor: pointer"><img src="{{ url('public/store/assets/img/icon-2.png') }}" alt=""/> <span class="colored">?????? ??????</span></span></li>`);
                            }
                        })
                    </script>
                </ul>
            </div>
            <div class="top-bar-left">
                <ul class="list-inline">
                    <!-- <li class="hidden-xs"><a href="about.html">???????????? ????</a></li> -->
                    <li class="hidden-xs"><a href="{{ url('/blog') }}">????????</a></li>
                    <li class="hidden-xs"><a href="{{ route('contact-us') }}">???????? ???? ????</a></li>
                    <!-- <li class="hidden-xs"><a href="faq.html">???????????? ???? ??????????</a></li> -->
                    <!-- <li class="hidden-xs"><a href="wishlist.html">?????????? ???????? ????</a></li> -->
                </ul>
            </div>
        </div>
    </div>
    <!-- /Header top bar -->

    <!-- HEADER -->
    <header class="header">
        <div class="header-wrapper">
            <div class="container">

                <!-- Logo -->
                <div class="logo" style="text-align: center">
                    <h3 style="font-weight: bold">
                        <a href="{{ route('home') }}">
                            ?????????????? <span style="color: black">??</span>
                            <hr>
                            {{-- <img src="{{ url('public/store/assets/img/logo.png') }}" alt="logo"> --}}
                            VITAMIN<span style="color: black">CHE</span>
                        </a>
                    </h3>
                </div>
                <!-- /Logo -->

                <!-- Header search -->
                <div class="header-search">
                    <form action="javascript:void(0)" id="search-form">
                        @csrf
                        <input class="form-control" type="text"  name="q" id="search-field" list="search" autocomplete="off" placeholder="?????????? ..."/>
                    </form>
                    <div class="col-sm-12" id="search" style="background: white; border: solid 1px green; z-index: 9999 !important"></div>
                    <button><i class="fa fa-search"></i></button>
                </div>
                <script>
                    $('#search-field').focusout(function() {
                        $('#search').delay('fast').fadeOut()
                    })
                    $('#search-field').on('keyup', function(){
                        var input = $(this).val();
                        if( input.length >= 3){
                            send_ajax_request(
                                `{{ route('search-list')}}`,
                                $('#search-form').serialize(),
                                function(body){
                                    // console.log(body);
                                    $('#search').html(body);
                                    $('#show-all-product').html(`???????????? ?????? ??????????: ${input}`)
                                    $('#show-all-product').attr('onclick', `show_catagory_by_part_of_name('${input}')`)
                                    $('#search').fadeIn();
                                },
                                function(data){
                                    console.log(data);
                                }
                            );
                            
                        }else{
                            $('#search').fadeOut();
                        }
                        
                    })
                </script>
                <!-- /Header search -->

                <!-- Header shopping cart -->
                <div class="header-cart">
                    <div class="cart-wrapper">
                        <a href="#" class="btn btn-theme-transparent" data-toggle="modal" data-target="#popup-cart"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs">  </span> <i class="fa fa-angle-down"></i></a>
                        <!-- Mobile menu toggle button -->
                        <a href="#" class="menu-toggle btn btn-theme-transparent"><i class="fa fa-bars"></i></a>
                        <!-- /Mobile menu toggle button -->
                    </div>
                </div>
                <!-- Header shopping cart -->

            </div>
        </div>
        <div class="navigation-wrapper">
            <div class="container">
                <!-- Navigation -->
                <nav class="navigation closed clearfix" >
                    <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
                    <ul class="nav sf-menu" >
                        <li class="active">
                            <a href="{{ route('home') }}">VITAMINCHE</a>
                        </li>
                        <li class="sale">
                            <a href="#" onclick="open_menu('main')">
                                ?????? ??????????????
                            </a>
                        </li>
                        <li class="sale">
                            <a href="#" onclick="show_view_in_element('{{ route('request.index') }}')">
                                ?????????????? ????????????
                            </a>
                        </li>
                        <li class="sale"><a href="{{ route('home') }}">??????????????</a></li>
                    </ul>
                </nav>
                <!-- /Navigation -->
            </div>
        </div>
    </header>
    <!-- /HEADER -->

    <!-- CONTENT AREA -->
    <div class="content-area">

        @yield('content')

    </div>
    <!-- /CONTENT AREA -->

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">

                    <div class="col-md-3">
                        <div class="widget">
                            <h4 class="widget-title">???????????? ????</h4>
                            <p></p>
                            <ul class="social-icons">
                                <li><a href="https://instagram.com/vitaminche.ir" class="instagram"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <h4 class="widget-title">??????????</h4>
                            <p>???? ?????????? ???? ???????????????? ???? ?????????? ???????????? ???????? ?????????? ???? ?????? ????????.</p>
                            <form action="#">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-theme btn-theme-transparent">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget widget-categories">
                            <h4 class="widget-title">??????????????</h4>
                            <ul>
                                <!-- <li><a href="#">???????????? ????</a></li> -->
                                <!-- <li><a href="#">?????????????? ?????????? ????????????</a></li> -->
                                <li><a href="{{ route('contact-us') }}">???????? ???? ????</a></li>
                                <li><a href="{{ route('blog') }}">??????????</a></li>
                                <!-- <li><a href="#">???????????? ?? ??????????</a></li> -->
                                <!-- <li><a href="#">???? ??????</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget widget-tag-cloud">
                            <h4 class="widget-title">???????? ???????? ????</h4>
                            <ul id="footer-catagory">
                                <script>
                                    $.get('{{ route("get-product-catagories") }}', function(data){
                                        // console.log(data);
                                        var d = $('#footer-catagory');
                                        var url = "{{ route('show-catagory-by-name', ['name' => 'cat_name' ]) }}"
                                        data.forEach(function(item){
                                            d.append(`<li><a href="${ url.replace('cat_name', item.name) }">${item.name}</a></li>`)
                                        })
                                    })
                                </script>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-meta">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="copyright">?????????? ???????? ?????? ???????? ?????????? ???? <a href="https://www.vitaminche.ir/"> vitaminche.ir<a/> ???? ????????</div>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

</div>
<!-- /WRAPPER -->

<!-- JS Global -->
<script src="{{ url('public/store/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ url('public/store/assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
{{-- <script src="{{ url('public/store/assets/plugins/superfish/js/superfish.min.js') }}"></script>
<script src="{{ url('public/store/assets/plugins/prettyphoto/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ url('public/store/assets/plugins/owl-carousel2/owl.carousel.min.js') }}"></script>
<script src="{{ url('public/store/assets/plugins/jquery.sticky.min.js') }}"></script>
<script src="{{ url('public/store/assets/plugins/jquery.easing.min.js') }}"></script>
<script src="{{ url('public/store/assets/plugins/jquery.smoothscroll.min.js') }}"></script>
<script src="{{ url('public/store/assets/plugins/smooth-scrollbar.min.js') }}"></script> --}}
<script src="{{ url('public/dashboard/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>

<!-- JS Page Level -->
<script src="{{ url('public/store/assets/js/theme.js') }}"></script>

<!--[if (gte IE 9)|!(IE)]><!-->
{{-- <script src="{{ url('public/store/assets/plugins/jquery.cookie.js') }}"></script> --}}
<!--<![endif]-->

<!-- Custome JS -->
@include('js.store')
<script src="{{ url('public/js/ajax.js') }}"></script>
<script src="{{ url('public/js/dataTable.js') }}"></script>
<script src="{{ url('public/js/dropzone.js') }}"></script>

@yield('script')


</body>
</html>