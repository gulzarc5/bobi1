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
					<div class="col-lg-12">
						<div class="login-title text-center mb-30">
							<h2>Forgot password</h2>
							<p>Insert here your username name</p>
						</div>
					</div>
					<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
						<div class="login-form">
							<form>
								<div class="single-login">
									<label>Username or email<span>*</span></label>
									<input type="text" />
								</div>
								<div class="single-login single-login-2">
									<button type="submit">login</button>
								</div>
							</form>
							<a href="{{URL::previous()}}">Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- user-login-area-end -->
		@endsection