		@extends('web.template.master')
		<!-- Head & Header Section -->
		@section('content') 
		<style>
			.disable_input{
				background: #d6cfcf none repeat scroll 0 0 !important;
				color: black !important;
    			font-weight: bold !important;
			}
		</style>
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-10">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#" class="active">checkout</a></li>
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
							<h2>User Detail</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- checkout-area-start -->
		<div class="checkout-area user-detail mb-70">
			<div class="container">
				<div class="row">						
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="checkbox-form mb-25">
							@if (isset($user_details) && !empty($user_details))
								<div class="row">
									<h5>User Details</h5>
									@if (Session::has('message'))
										<div class="alert alert-success" >{{ Session::get('message') }}</div>
									@endif
									@if (Session::has('error'))
										<div class="alert alert-danger">{{ Session::get('error') }}</div>
									@endif
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Name <span class="required">*</span></label>										
										<input type="text" name="name" value="{{$user_details->name}}" disabled class="disable_input">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Email <span class="required">*</span></label>										
										<input type="text" name="email" value="{{$user_details->email}}" disabled class="disable_input">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Mobile</label>
											<input type="number" name="mobile" value="{{$user_details->mobile}}" disabled class="disable_input">
										</div>
									</div>
									<div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top: 2px;">
										<div class="country-select">
											<label>Gender <span class="required">*</span></label>
											<select disabled name="gender" class="disable_input">
												<option value="">Select Gender</option>
												<option value="M" {{ $user_details->gender == 'M' ? 'selected' : '' }}>Male</option>
												<option value="F" {{ $user_details->gender == 'F' ? 'selected' : '' }}>Female</option>
											</select> 										
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>PAN Number <span class="required">*</span></label>										
											<input type="text" name="pan" value="{{$user_details->pan}}" disabled class="disable_input">
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Date Of Birth</label>
											<input type="date" disabled class="disable_input" name="dob" value="{{$user_details->dob}}">
										</div>
									</div>
									
									<h5>User Address</h5>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="country-select">
											<label>Select State <span class="required">*</span></label>			
											<select disabled name="gender" class="disable_input">
												<option value="" selected>{{$user_details->s_name}}</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="country-select">
											<label>Select City <span class="required">*</span></label>
											<select disabled name="gender" class="disable_input">
												<option value="" selected>{{$user_details->c_name}}</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Postcode / Zip <span class="required">*</span></label>									
											<input type="text" value="{{$user_details->pin}}" class="disable_input" disabled >
										</div>
									</div>
									
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="checkout-form-list">
											<label>Address <span class="required">*</span></label>
											<textarea type="text" disabled class="disable_input form-control">{{$user_details->address}}</textarea>
										</div>
									</div>	
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<center><a href="{{route('web.myProfileEdit')}}"><button class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit User Detail</button></a></center>
									</div>																
								</div>	
							@endif												
						</div>
						
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
				</div>
			</div>
		</div>
		<!-- checkout-area-end -->
		@endsection