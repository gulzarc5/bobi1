<!doctype html>
<html class="no-js" lang="en">
    
	<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Edujiyaan | Online Store For Book Mazagine Documents</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="{{('web/img/favicon.png')}}">
		
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}">
		<!-- animate css -->
        <link rel="stylesheet" href="{{asset('web/css/animate.css')}}">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="{{asset('web/css/meanmenu.min.css')}}">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="{{asset('web/css/owl.carousel.css')}}">
		<!-- font-awesome css -->
        <link rel="stylesheet" href="{{asset('web/css/font-awesome.min.css')}}">
		<!-- flexslider.css-->
        <link rel="stylesheet" href="{{asset('web/css/flexslider.css')}}">
		<!-- chosen.min.css-->
        <link rel="stylesheet" href="{{asset('web/css/chosen.min.css')}}">
		<!-- style css -->
		<link rel="stylesheet" href="{{asset('web/css/style.css')}}">
		<!-- responsive css -->
        <link rel="stylesheet" href="{{asset('web/css/responsive.css')}}">
        <!-- custom css -->
		<link rel="stylesheet" href="{{asset('web/css/custom.css')}}">
		<!-- modernizr css -->
        <script src="{{asset('web/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    </head>
    <body>
		<!-- header-area-start -->
        <header>
			<!-- header-top-area-start -->
			<div class="header-top-area hidden-xs">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="language-area">
								<ul>
									<li><a>Welcome to Edujiyaan !!</a></li>									
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="account-area language-area text-right">
								<ul>
									<li><a href="{{route('web.user.membership')}}">Membership</a></li>
									@auth('buyer')
										<li><a href="#">{{ Auth::guard('buyer')->user()->name }}</a></li>
										<li><a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
										<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									@else
										<li><a href="{{route('web.user_login')}}">Sign in</a></li>
										<li><a href="{{route('web.signup')}}">Sign Up</a></li>
										<li><a href="{{route('seller_login')}}">Seller Sign in</a></li>
									@endauth
									
									<li><a>My Account<i class="fa fa-angle-down"></i></a>
										<div class="header-sub">
											<ul>
												<li><a href="{{route('web.myProfile')}}">My Profile</a></li>
												<li><a href="{{route('web.change_password_form')}}">Change Password</a></li>
												<li><a href="{{route('web.view_orders', ['tab_status' => encrypt(1)])}}">My Orders</a></li>
												<li><a href="{{route('web.view_shipping_address_list')}}">My Shipping Address</a></li>
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- header-top-area-end -->
			<!-- header-mid-area-start -->
			<div class="header-mid-area ptb-10">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-5 hidden-xs">
							<div class="header-img pt-25">
								<img src="{{asset('web/img/icons/shop.png')}}">
								<a href="{{route('seller_login')}}"></i>sell on edujiyaan</a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
							<div class="logo-area text-center logo-xs-mrg">
							<a class="head-img" href="{{route('web.index')}}"><img src="{{asset('web/img/logo/logo.png')}}" alt="logo" /></a>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">
							<div class="my-cart pt-25">
								<ul>
									<li><a href="{{route('web.view_cart')}}"><i class="fa fa-shopping-cart"></i>My Cart</a>
										<span>
											@if (isset($cart_data_header['cart_count']) && !empty($cart_data_header['cart_count']))
												{{$cart_data_header['cart_count']}}		
											@else
												0
											@endif
										</span>
										<div class="mini-cart-sub">
											@php
												$cart_amount = 0;
											@endphp
											@if (isset($cart_data_header['cart_data']) && !empty($cart_data_header['cart_data']) )
											
												<div class="cart-product">
													@foreach ($cart_data_header['cart_data'] as $item)
														<div class="single-cart">
															<div class="cart-img">
																<a href="#"><img src="{{asset('images/book_image/thumb/'.$item->book_image.'')}}" alt="book" /></a>
															</div>
															<div class="cart-info">
																<h5><a href="#">{{$item->book_name}}</a></h5>
																<p>{{$item->quantity}} x ₹ {{ number_format($item->price,2,".",'')}}</p>
															</div>
															<div class="cart-icon">
																<a href="#"><i class="fa fa-remove"></i></a>
															</div>
														</div>
														@php
															$cart_amount += (floatval($item->quantity) * floatval($item->price));
														@endphp
													@endforeach
													
												</div>
												<div class="cart-totals">
													<h5>Total <span> ₹ {{ number_format($cart_amount,2,".",'')}}</span></h5>
												</div>
												<div class="cart-bottom">
													<a class="view-cart" href="{{route('web.view_cart')}}">view cart</a>
													{{-- <a href="checkout.html">Check out</a> --}}
												</div>
											@else
												<h5 style="display:flex;justify-content:center">Cart Is Empty</h5>
											@endif
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- header-mid-area-end -->
			<!-- main-menu-area-start -->
			<div class="main-menu-area hidden-sm hidden-xs sticky-header-1" id="header-sticky">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 flex-center">
							<div class="menu-area">
								<nav>
									<ul style="display: flex;justify-content: center;">
										<li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{route('web.index')}}">Home</a></li>
										<li class="{{  (request()->is('Book/List*')) ? 'active' : '' }}"><a href="{{route('web.new_book_list')}}">Books</a></li>
										<li class="{{  (request()->is('Book/Old*')) ? 'active' : '' }}"><a href="{{route('web.old_book_list')}}">Old Books</a></li>
										<li class="{{  (request()->is('project*')) ? 'active' : '' }}"><a href="{{route('web.project_list')}}">Projects</a></li>
										<li class="{{  (request()->is('megazine*')) ? 'active' : '' }}"><a href="{{route('web.megazine_list')}}">Magazines</a></li>
										<li class="{{  (request()->is('Quiz*')) ? 'active' : '' }}"><a href="{{route('web.quiz_list')}}">Quiz</a></li>
										<li class="{{  (request()->is('Tips-&-Tricks*')) ? 'active' : '' }}"><a href="{{route('web.thankyou.tips')}}">Tips and Tricks</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- main-menu-area-end -->
			<!-- mobile-menu-area-start -->
			<div class="mobile-menu-area hidden-md hidden-lg">
				<div class="container">
					<div class="row" style="">
						<div class="col-lg-12">
							<div class="mobile-menu">
								<nav id="mobile-menu-active">
									<ul id="nav">
										@auth('buyer')
											<li><a class="user-wel">{{ Auth::guard('buyer')->user()->name }}</a></li>
										@endauth
									<li class="active"><a href="{{route('web.index')}}">Home</a></li>
										<li><a href="{{route('web.new_book_list')}}">Books</a></li>
										<li><a href="{{route('web.old_book_list')}}">Old Books</a></li>
										<li><a href="{{route('web.project_list')}}">Projects</a></li>
										<li><a href="{{route('web.megazine_list')}}">Magazines</a></li>
										<li><a href="{{route('web.quiz_list')}}">Quiz</a></li>
										<li class="pb-5"><a href="#">Tips and Tricks</a></li>
										<!-- main-menu-area-end -->
										<li class="bdr-top"><a>My Account</a>
											<div class="sub-menu">
												<ul>
													<li><a href="{{route('web.myProfile')}}">My Profile</a></li>
													<li><a href="{{route('web.change_password_form')}}">Change Password</a></li>
													<li><a href="{{route('web.view_orders', ['tab_status' => encrypt(1)])}}">My Orders</a></li>
													<li><a href="{{route('web.view_shipping_address_list')}}">My Shipping Address</a></li>
												</ul>
											</div>
										</li>
										<li><a href="{{route('web.user.membership')}}">Membership</a></li>
										@auth('buyer')
											<li><a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
											<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										@else
											<li><a href="{{route('web.user_login')}}">Sign in</a></li>
											<li><a href="{{route('web.signup')}}">Sign Up</a></li>
											<li><a href="{{route('seller_login')}}">Seller Sign in</a></li>
										@endauth
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- mobile-menu-area-end -->
		</header>