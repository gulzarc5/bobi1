		@extends('web.template.master')
		<!-- Head & Header Section -->
		@section('content') 
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-10">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#" class="active">login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- user-login-area-start -->
		<div class="user-login-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
						<div class="login-form">
							<div class="row">
								<div class="col-lg-12 thanks">
									<h1>THANK YOU</h1>
									<i class="fa fa-check-circle flex-center" aria-hidden="true"></i>
									<p class="mt-20">Your order has been placed. You will soon receive a confirmation SMS</p>
									<div class="flex-center mt-20" style="width: 100%"><button>Continue Shoping</button></div>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- user-login-area-end -->
		@endsection