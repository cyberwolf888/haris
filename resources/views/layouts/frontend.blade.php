<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- CSS -->
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/bootstrap.min.css">
    <!-- Icon Font CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/material-design-iconic-font.min.css">
    <!-- Plugins Import CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/import.css">
    <!-- Style CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/style.css">
    <!-- Responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/responsive.css">

    <!-- Style customizer (Remove these two lines please) -->
    <link rel="stylesheet" href="{{ url('assets/frontend') }}/css/style-customizer.css">
    <link href="{{ url('assets/frontend') }}/css/color/color-7.css" data-style="styles" rel="stylesheet">
    @stack('plugin_css')

    <!-- Modernizer JS
    ============================================ -->
    <script src="{{ url('assets/frontend') }}/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        .logo {
            display: inline-block;
            margin: 20px 0 44px;
            vertical-align: top;
        }
        .stick .logo {
            margin: 10px 0 24px;
        }
    </style>

</head>
<body>
<!-- Pre Loader
============================================ -->
<div class="preloader">
    <div class="loading-center">
        <div class="loading-center-absolute">
            <div class="object object_one"></div>
            <div class="object object_two"></div>
            <div class="object object_three"></div>
        </div>
    </div>
</div>
<!-- Body main wrapper start -->
<div class="wrapper bg-white fix">

    <!-- Header 1
    ============================================ -->
    <div class="header-area sticky header-area-1  clearfix">
        <!-- Header Left 1 -->
        <div class="header-left header-left-1 float-left">
            <a href="index.html" class="logo"><img src="{{ url('assets/frontend') }}/img/logo.jpg" alt="logo" /></a>
        </div>
        <!-- Menu Wrapper 1 -->
        <div class="menu-wrapper menu-wrapper-1 hidden-sm hidden-xs text-center">
            <div class="menu menu-1">
                <nav>
                    <ul>
                        <li class="@if (str_is('home', Route::currentRouteName())) active @endif"><a href="{{ route('home') }}">Home</a></li>
                        <li class="@if (str_is('frontend.category', Route::currentRouteName())) active @endif"><a href="#">Category</a>
                            <ul class="sub-menu">
                                @foreach(\App\Models\Category::all() as $category)
                                <li><a href="{{ route('frontend.category',base64_encode($category->id)) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="@if (str_is('frontend.hotsales', Route::currentRouteName())) active @endif"><a href="{{ route('frontend.hotsales') }}">Hot Sales</a></li>
                        <li class="@if (str_is('frontend.newitem', Route::currentRouteName())) active @endif"><a href="{{ route('frontend.newitem') }}">New Item</a></li>
                        <li class="@if (str_is('frontend.contact', Route::currentRouteName())) active @endif"><a href="{{ route('frontend.contact') }}">contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Header Right 1 -->
        <div class="header-right header-right-1 float-right">
            <!-- Account Menu -->
            <div class="account-menu account-menu-1 float-right">
                <button data-toggle="dropdown" class="acc-menu-toggle"><i class="zmdi zmdi-account"></i></button>
                <ul class="acc-menu-dropdown dropdown-menu right">
                    @if(!Auth::check())
                    <li><a href="{{ url('login') }}">login</a></li>
                        <li><a href="{{ url('register') }}">Register</a></li>
                    @else
                    <li><a href="{{ route('member.dashboard') }}">My Account</a></li>
                    <li>
                        <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                    @endif
                </ul>
            </div>
            <!-- Mini Cart -->
            <div class="mini-cart-wrapper mini-cart-wrapper-1 float-right">
                <a href="#" data-toggle="dropdown" class="mini-cart-btn"><span><i class="zmdi zmdi-shopping-cart"></i><span class="cart-number">{{ \Cart::instance('cart')->count() }}</span></span></a>
                <div class="mini-cart dropdown-menu right">
                    @if(\Cart::instance('cart')->count()>0)
                        @foreach(Cart::instance('cart')->content() as $row)
                            <div class="mini-cart-product fix">
                                <a href="#" class="image"><img src="{{ $row->model->getImage() }}" alt="" /></a>
                                <div class="content fix">
                                    <a href="{{ route('frontend.product_detail',$row->model->id) }}" class="title"> {{ $row->name }} </a>
                                    <p>Qty: {{ $row->qty }}</p>
                                    <p>Rp {{ number_format($row->price*$row->qty,0,',','.') }}</p>
                                    <button class="remove" onclick="document.getElementById('rowId').value = '{{ $row->rowId }}';document.getElementById('cart-delete-form').submit();"><i class="zmdi zmdi-close"></i></button>
                                </div>
                            </div>
                        @endforeach
                        <form id="cart-delete-form" action="{{ route('frontend.cart.delete') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="rowId" id="rowId" value="">
                        </form>
                        <div class="mini-cart-checkout text-center">
                            <a href="{{ route('frontend.cart.manage') }}">checkout</a>
                        </div>
                    @else
                        <h3 style="color: white;">Cart is empty</h3>
                    @endif
                </div>
            </div>
            <!-- Header Search -->
            <div class="header-search header-search-1 hidden-xs float-right">
                <button data-toggle="dropdown" class="search-toggle" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
                <div class="search-dropdown dropdown-menu right">
                    <form action="{{ route('frontend.search') }}">
                        <input type="text" placeholder="Search Product..." name="keywords" required>
                    </form>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Wrapper 1 -->
        <div class="mobile-menu-wrapper mobile-menu-wrapper-1 hidden-md hidden-lg">
            <div class="mobile-menu mobile-menu-1">
                <nav>
                    <ul>
                        <li class="@if (str_is('home', Route::currentRouteName())) active @endif"><a href="{{ route('home') }}">Home</a></li>
                        <li class="@if (str_is('frontend.category', Route::currentRouteName())) active @endif"><a href="#">Category</a>
                            <ul>
                                @foreach(\App\Models\Category::all() as $category)
                                    <li><a href="{{ route('frontend.category',base64_encode($category->id)) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="@if (str_is('frontend.hotsales', Route::currentRouteName())) active @endif"><a href="{{ route('frontend.hotsales') }}">Hot Sales</a></li>
                        <li class="@if (str_is('frontend.newitem', Route::currentRouteName())) active @endif"><a href="{{ route('frontend.newitem') }}">New Item</a></li>
                        <li class="@if (str_is('frontend.contact', Route::currentRouteName())) active @endif"><a href="{{ route('frontend.contact') }}">contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    @yield('content')

    <!-- Newsletter Area
    ============================================ -->
    <div class="newsletter-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="newsletter-wrapper">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
                            <h3>Promotion Sign-Up</h3>
                            <div class="newsletter-form float-right">
                                <form id="mc-form" class="mc-form" action="{{ route('frontend.subscribe') }}" method="post">
                                    {{ csrf_field() }}
                                    <input id="phone" name="phone" type="text" autocomplete="off" placeholder="Enter Email Address..." />
                                    <input id="mc-submit" type="submit" value="subscribe" />
                                </form>
                                <!-- mailchimp-alerts Start -->
                                <div class="mailchimp-alerts text-centre">
                                    <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                    <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                    <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                                </div><!-- mailchimp-alerts end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer 5 Top Area
    ============================================ -->
    <div class="footer-top-area pb-70 pt-130">
        <div class="container">
            <div class="row">
                <div class="footer-about col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <img src="{{ url('assets/frontend') }}/img/logo.jpg" alt="" />
                    <p>Kami adalah toko pakaian yang memberikan harga terbaik dengan kualitas terbaik untuk anda.</p>
                    <div class="footer-social fix">
                        <a href="https://www.facebook.com/SlashRockGear"><i class="zmdi zmdi-facebook"></i></a>
                        <a href="https://www.instagram.com/slashrockgear/"><i class="zmdi zmdi-instagram"></i></a>
                        <a href="https://twitter.com/SlashrockGear"><i class="zmdi zmdi-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-information col-lg-3 col-md-2 col-sm-6 col-xs-12">
                    <h4>Information</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('frontend.hotsales') }}">Hot Sales</a></li>
                        <li><a href="{{ route('frontend.newitem') }}">New Item</a></li>
                        <li><a href="{{ route('frontend.contact') }}">Contact</a></li>

                    </ul>
                </div>
                <div class="footer-account col-lg-3 col-md-2 col-sm-6 col-xs-12">
                    <h4>my accounts</h4>
                    <ul>
                        <li><a href="{{ route('member.dashboard') }}">My Account</a></li>
                        <li><a href="{{ route('member.transaction.manage') }}">My Transaction</a></li>
                        <li><a href="{{ route('member.profile.index') }}">My Profile</a></li>
                        <li><a href="{{ url('login') }}">Login</a></li>
                    </ul>
                </div>
                <div class="footer-contact-2 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <h4>Contact us</h4>
                    <div class="sin-footer-contact fix">
                        <i class="zmdi zmdi-pin"></i>
                        <span>Jalan Raya Krebokan No.888</span>
                    </div>
                    <div class="sin-footer-contact fix">
                        <i class="zmdi zmdi-email"></i>
                        <span>Username@gmail.com</span>
                    </div>
                    <div class="sin-footer-contact fix">
                        <i class="zmdi zmdi-phone"></i>
                        <span>+660 256 24857</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer 5 Bottom Area
    ============================================ -->
    <div class="footer-bottom-area pb-20 pt-20">
        <div class="container">
            <div class="row">
                <div class="copyright text-left col-sm-6 col-xs-12">
                    <p>Copyright &copy; {{ date('Y') }} <a href="#" target="_blank">STIKOM Bali</a>. All Right Reserved.</p>
                </div>
                <div class="payment-method text-right col-sm-6 col-xs-12">
                    <img src="{{ url('assets/frontend') }}/img/payment/1.png" alt="payment" />
                    <img src="{{ url('assets/frontend') }}/img/payment/3.png" alt="payment" />
                    <img src="{{ url('assets/frontend') }}/img/payment/4.png" alt="payment" />
                </div>
            </div>
        </div>
    </div>


</div>
<!-- Body main wrapper end -->


<!-- JS -->

<!-- jQuery JS
============================================ -->
<script src="{{ url('assets/frontend') }}/js/vendor/jquery-1.12.0.min.js"></script>
<!-- Bootstrap JS
============================================ -->
<script src="{{ url('assets/frontend') }}/js/bootstrap.min.js"></script>
<!-- Plugins JS
============================================ -->
<script src="{{ url('assets/frontend') }}/js/plugins.js"></script>

<!-- Main JS
============================================ -->
<script src="{{ url('assets/frontend') }}/js/main.js"></script>
@stack('plugin_scripts')

<script>
    $('#mc-form').submit(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '<?= route('frontend.subscribe') ?>',
            type: 'POST',
            data: {phone:$("#phone").val(), _token:CSRF_TOKEN},
            success: function (data) {
                if(data == "1"){
                    $('.mailchimp-success').html('' + "Thank you for your subscribe!").fadeIn(900);
                    $('.mailchimp-error').fadeOut(400);
                }else{
                    $('.mailchimp-error').html('' + "Your are already subscriber!").fadeIn(900);
                    $('.mailchimp-success').fadeOut(400);
                }
            }
        });
        return false;

        //alert("Thank you for your comment!");
    });
</script>
@stack('scripts')
</body>
</html>
