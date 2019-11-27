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
								<li><a href="#" class="active">register</a></li>
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
							<h2>Seller Regitration</h2>
							<p>Insert your name and other details</p>
							@if (Session::has('message'))
								<div class="alert alert-success">{{ Session::get('message') }}</div>
							@endif @if (Session::has('error'))
								<div class="alert alert-danger">{{ Session::get('error') }}</div>
							@endif
						</div>
						
					</div>
					@if (isset($user) && !empty($user))
					{{ Form::open(['method' => 'post','route'=>'web.seller-submit']) }}
						<div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
							<div class="billing-fields">
									<div class="single-register">
										<label>Name<span>*</span></label>
										<input type="text" name="name" value="{{$user->name}}"/>
										@if($errors->has('name'))
											<span class="invalid-feedback" role="alert" style="color:red">
												<strong>{{ $errors->first('name') }}</strong>
											</span>
										@enderror
									</div>
									<div class="row">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="single-register">
												<label>Email Address<span>*</span></label>
											<input type="text" name="email" value="{{$user->email}}" disabled style="background: lightgray;"/>
											</div>
											@if($errors->has('email'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('email') }}</strong>
												</span>
											@enderror
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="single-register">
												<label>Mobile<span>*</span></label>
											<input type="number" name="mobile" value="{{$user->mobile}}" disabled style="background: lightgray;"/>
											</div>
											@if($errors->has('mobile'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('mobile') }}</strong>
												</span>
											@enderror
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="single-register">
												<label>Gender<span>*</span></label>
												<select class="chosen-select" tabindex="1" style="width:100%;" data-placeholder="Default Sorting" name="gender">
													<option value="" selected>Select a Gender</option>
													@if ($user->gender == 'M')
														<option value="M" selected>Male</option>
														<option value="F">Female</option>
													@elseif($user->gender == 'F')
														<option value="M">Male</option>
														<option value="F" selected>Female</option>
													@else
														<option value="M">Male</option>
														<option value="F">Female</option>
													@endif
													
													
												</select>
											</div>
										</div>
									</div>
									<div class="single-register">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 check">
												<label>What You Want to Sell*</label>
												<p class="option option1"><input type="checkbox" name="book" value="1">Book</p>
												<p class="option option1"><input type="checkbox" name="project" value="1">Projects</p>
												<p class="option option1"><input type="checkbox" name="megazine" value="1">Magazines </p>
											</div>
										</div>
									</div>
									<div class="single-register">
										<button type="submit">Register</button>
									</div>
								<a href="{{route('web.user_login')}}">Already Signed up? Login</a>
							</div>
						</div>
					{{ Form::close() }}
					@endif
				</div>
			</div>
		</div>
		<!-- user-login-area-end -->
@endsection
@section('script')
@endsection