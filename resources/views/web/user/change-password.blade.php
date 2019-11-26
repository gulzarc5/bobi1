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
								<li><a href="#" class="active">Change Password</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- entry-header-area-start -->
		<div class="entry-header-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title-5 mb-30" style="text-align: center;">
							<h2>Change Password</h2>
							@if (Session::has('message'))
								<div class="alert alert-success" >{{ Session::get('message') }}</div>
							@endif
							@if (Session::has('error'))
								<div class="alert alert-danger">{{ Session::get('error') }}</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- checkout-area-start -->
		<div class="checkout-area add-ship-addrs select-add mb-70">
			<div class="container">
				<div class="row">						
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="checkbox-form mb-25">
						{{ Form::open(['method' => 'post','route'=>'web.change_password']) }}
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="checkout-form-list">
										<label>Current Password <span class="required">*</span></label>
										<input type="password" name="current_password">
										@if($errors->has('current_password'))
											<span class="invalid-feedback" role="alert" style="color:red">
												<strong>{{ $errors->first('current_password') }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="checkout-form-list">
										<label>New Password<span class="required">*</span></label>
										<input type="password" name="new_password">
										@if($errors->has('new_password'))
											<span class="invalid-feedback" role="alert" style="color:red">
												<strong>{{ $errors->first('new_password') }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="checkout-form-list">
										<label>Re-Enter Password <span class="required">*</span></label>
										<input type="password" name="confirm_password">
										@if($errors->has('confirm_password'))
											<span class="invalid-feedback" role="alert" style="color:red">
												<strong>{{ $errors->first('confirm_password') }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flex-center ptb-20">
									<button class="btn btn-success" style="padding: 10px 30px;"> Submit </button>
								</div>																		
							</div>
						{{ Form::close() }}											
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
				</div>
			</div>
		</div>
		<!-- checkout-area-end -->
		@endsection