<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gaming Gen Dashboard</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<link rel="stylesheet" href="{{url('/')}}/backend_assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{url('/')}}/backend_assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{url('/')}}/backend_assets/css/fontastic.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<link rel="stylesheet" href="{{url('/')}}/backend_assets/css/grasp_mobile_progress_circle-1.0.0.min.css">
	<link rel="stylesheet" href="{{url('/')}}/backend_assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="{{url('/')}}/backend_assets/css/style.default.css" id="theme-stylesheet">
	<link rel="stylesheet" href="{{url('/')}}/backend_assets/css/custom.css">
    <link rel="shortcut icon" href="{{url('/')}}/backend_assets/{{url('/')}}/backend_assets/img/favicon.ico">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @yield('header_css')

    <style>
        .page{
            background: #F7F8F8;
            background: -webkit-linear-gradient(to left, #ACBB78, #F7F8F8);
            background: linear-gradient(to left, #ACBB78, #F7F8F8);
        }
    </style>

</head>

<body>
	<!-- Side Navbar -->
	<nav class="side-navbar">
		<div class="side-navbar-wrapper">
			<!-- Sidebar Header-->
			<div class="sidenav-header d-flex align-items-center justify-content-center">
				<!-- User Info-->
				<div class="sidenav-header-inner text-center"><img src="{{url('/')}}/backend_assets/img/admin2.png" alt="person" class="img-fluid rounded-circle">
					<h2 class="h5">{{Auth::user()->name}}</h2><span>{{Auth::user()->email}}</span>
				</div>
				<!-- Small Brand information, appears on minimized sidebar-->
				<div class="sidenav-header-logo"><a href="{{url('/home')}}" class="brand-small text-center"> <strong>NGO</strong><strong class="text-primary">F</strong></a></div>
			</div>
			<!-- Sidebar Navigation Menus-->
			<div class="main-menu">
				<h5 class="sidenav-heading">MENU</h5>
				<ul id="side-main-menu" class="side-menu list-unstyled">
					<li><a href="{{url('/home')}}"> <i class="icon-home"></i>Home </a></li>
					<li><a href="{{url('/slider/page')}}"> <i class="far fa-images"></i> Sliders </a></li>
					<li><a href="{{url('/game/page')}}"> <i class="fas fa-gamepad"></i> Games </a></li>
					<li><a href="{{url('/trend/page')}}"> <i class="fab fa-fantasy-flight-games"></i> Trends </a></li>
                    <li>
                        <a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse">
                             <i class="fas fa-fighter-jet"></i> Contest
                             <span class="text-warning">
                                @if(DB::table('contest_subscriptions')->where('status',0)->count() > 0)
                                    ({{DB::table('contest_subscriptions')->where('status',0)->count()}})
                                @endif
                            </span>
                        </a>
						<ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
							<li><a href="{{url('/contest/page')}}">Add New Contest</a></li>
							<li><a href="{{url('/view/all/contests')}}">View All Contest</a></li>
							<li><a href="{{url('/manage/contest')}}">Approve/Deny <span class="text-warning">
                                @if(DB::table('contest_subscriptions')->where('status',0)->count() > 0)
                                    ({{DB::table('contest_subscriptions')->where('status',0)->count()}})
                                @endif
                            </span></a></li>
						</ul>
                    </li>
					<li><a href="{{url('/contest/winner/page')}}"> <i class="fas fa-trophy"></i> Contest Winner </a></li>
                    <li><a href="{{url('/withdraw/amount/page')}}"> <i class="fas fa-hand-holding-usd"></i> WithDraw Amount
                        <span class="text-warning">
                            @if(DB::table('with_draws')->where('status',0)->count() > 0)
                                ({{DB::table('with_draws')->where('status',0)->count()}})
                            @endif
                        </span>
                    </a></li>

                    <li><a href="{{url('/add/money/page')}}">
                        <i class="fas fa-coins"></i>
                        Add Money
                        <span class="text-warning">
                            @if(DB::table('add_money')->where('status',0)->count() > 0)
                                ({{DB::table('add_money')->where('status',0)->count()}})
                            @endif
                        </span> </a>
                    </li>

                    <li><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse">
                        <i class="fas fa-store"></i> Gen Store
                        <span class="text-warning">
                            @if(DB::table('package_requests')->where('status',0)->count() > 0)
                                ({{DB::table('package_requests')->where('status',0)->count()}})
                            @endif
                        </span>
                    </a>
						<ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
							<li><a href="{{url('/package/page')}}">Add New Package</a></li>
                            <li><a href="{{url('/manage/package')}}">Approve/Deny
                                <span class="text-warning">
                                    @if(DB::table('package_requests')->where('status',0)->count() > 0)
                                        ({{DB::table('package_requests')->where('status',0)->count()}})
                                    @endif
                                </span></a>
                            </li>
						</ul>
                    </li>
                    <li><a href="{{url('/contest/rating/page')}}"> <i class="fas fa-poll-h"></i> Contest Survey </a></li>
                    <li><a href="{{url('/payment/page')}}"> <i class="fas fa-money-check-alt"></i> Payment </a></li>

				</ul>
			</div>
		</div>
	</nav>
	<div class="page">
		<!-- navbar-->
		<header class="header">
			<nav class="navbar">
				<div class="container-fluid">
					<div class="navbar-holder d-flex align-items-center justify-content-between">
						<div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="{{url('/home')}}" class="navbar-brand">
								<div class="brand-text d-none d-md-inline-block"><span></span><strong class="text-primary">Dashboard</strong></div>
							</a></div>
						<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

							<!-- Log out-->
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link logout" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"> <span class="d-none d-sm-inline-block">Logout</span>
                                    <i class="fa fa-sign-out"></i>
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

						</ul>
					</div>
				</div>
			</nav>
        </header>


        @yield('content')


		<footer class="main-footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<p>&copy; NGO Forum 2020</p>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- JavaScript files-->
	<script src="{{url('/')}}/backend_assets/vendor/jquery/jquery.min.js"></script>
	<script src="{{url('/')}}/backend_assets/vendor/popper.js/umd/popper.min.js"> </script>
	<script src="{{url('/')}}/backend_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{url('/')}}/backend_assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
	<script src="{{url('/')}}/backend_assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
	<script src="{{url('/')}}/backend_assets/vendor/chart.js/Chart.min.js"></script>
	<script src="{{url('/')}}/backend_assets/vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="{{url('/')}}/backend_assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{url('/')}}/backend_assets/js/charts-home.js"></script>

    @yield('footer_js')

	<!-- Main File-->
	<script src="{{url('/')}}/backend_assets/js/front.js"></script>
    <script src="https://kit.fontawesome.com/c218529370.js"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>

</html>
