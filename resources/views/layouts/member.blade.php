<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>{{ env('APP_NAME') }} | Member</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ url('assets/backend') }}/plugins/materialize/css/materialize.min.css"/>
    <link href="{{ url('assets/backend') }}/icons/material-icons.css" rel="stylesheet">
    <link href="{{ url('assets/backend') }}/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
    <link href="{{ url('assets/backend') }}/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
    <link href="{{ url('assets/backend') }}/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">
@stack('plugin_css')


<!-- Theme Styles -->
    <link href="{{ url('assets/backend') }}/css/alpha.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/backend') }}/css/custom.css" rel="stylesheet" type="text/css"/>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="loader-bg"></div>
<div class="loader">
    <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-blue">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
        <div class="spinner-layer spinner-teal lighten-1">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
        <div class="spinner-layer spinner-yellow">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
        <div class="spinner-layer spinner-green">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
<div class="mn-content fixed-sidebar">
    <header class="mn-header navbar-fixed">
        <nav class="red darken-1">
            <div class="nav-wrapper row">
                <section class="material-design-hamburger navigation-toggle">
                    <a href="javascript:void(0)" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                        <span class="material-design-hamburger__layer"></span>
                    </a>
                </section>
                <div class="header-title col s3 m3">
                    <span class="chapter-title">SLASHROCK</span>
                </div>
                <ul class="right col s9 m3 nav-right-menu">
                    <?php $new_order = \App\Models\Transaction::where('status',\App\Models\Transaction::NEW_ORDER)->where('member_id',Auth::user()->id)->count(); ?>
                    <li class="hide-on-small-and-down"><a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button dropdown-right show-on-large"><i class="material-icons">notifications_none</i>@if($new_order>0)<span class="badge">{{$new_order}}</span>@endif</a></li>
                    <li class="hide-on-med-and-up"><a href="javascript:void(0)" class="search-toggle"><i class="material-icons">search</i></a></li>
                </ul>

                <ul id="dropdown1" class="dropdown-content notifications-dropdown">
                    @if($new_order>0)
                        <?php $tr = \App\Models\Transaction::where('status',\App\Models\Transaction::NEW_ORDER)->where('member_id',Auth::user()->id)->get(); ?>
                        <li class="notificatoins-dropdown-container">
                            <ul>
                                <li class="notification-drop-title">New Transaction</li>
                                @foreach($tr as $row)
                                    <li>
                                        <a href="{{ route('member.transaction.show',['id'=>$row->id]) }}">
                                            <div class="notification">
                                                <div class="notification-icon circle green"><i class="material-icons">add_shopping_cart</i></div>
                                                <div class="notification-text"><p>Rp {{ number_format($row->total,0,',','.') }} | {{ $row->fullname }}</p><span>{{ date('d F Y, H:i',strtotime($row->created_at)) }}</span></div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>



    <aside id="slide-out" class="side-nav white fixed">
        <div class="side-nav-wrapper">
            <div class="sidebar-profile">
                <div class="sidebar-profile-image">
                    <img src="{{ url('assets/backend') }}/images/avatar.jpg" class="circle" alt="">
                </div>
                <div class="sidebar-profile-info">
                    <a href="javascript:void(0);" >
                        <p>{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                        <span>{{ \Illuminate\Support\Facades\Auth::user()->email }}</span>
                    </a>
                </div>
            </div>
            <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                <li class="no-padding"><a class="waves-effect waves-grey" href="{{ route('home') }}"><i class="material-icons">home</i>Home</a></li>
                <li class="no-padding"><a class="waves-effect waves-grey" href="{{ route('member.dashboard') }}"><i class="material-icons">settings_input_svideo</i>Dashboard</a></li>
                <li class="no-padding"><a class="waves-effect waves-grey" href="{{ route('member.transaction.manage') }}"><i class="material-icons">shopping_cart</i>Transaction</a></li>
                <li class="no-padding">
                    <a class="waves-effect waves-grey" href="{{ route('member.profile.index') }}"><i class="material-icons">account_circle</i>Profile</a>
                </li>
                <li class="no-padding">
                    <a class="waves-effect waves-grey" href="{{ url('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="material-icons">exit_to_app</i>Sign Out
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <div class="footer">
                <p class="copyright">STIKOM Bali ©</p>
                <a href="#!">Privacy</a> &amp; <a href="#!">Terms</a>
            </div>
        </div>
    </aside>
    @yield('content')

</div>
<div class="left-sidebar-hover"></div>


<!-- Javascripts -->
<script src="{{ url('assets/backend') }}/plugins/jquery/jquery-2.2.0.min.js"></script>
<script src="{{ url('assets/backend') }}/plugins/materialize/js/materialize.min.js"></script>
<script src="{{ url('assets/backend') }}/plugins/material-preloader/js/materialPreloader.min.js"></script>
<script src="{{ url('assets/backend') }}/plugins/jquery-blockui/jquery.blockui.js"></script>
@stack('plugin_scripts')
<script src="{{ url('assets/backend') }}/js/alpha.min.js"></script>
@stack('scripts')

</body>
</html>