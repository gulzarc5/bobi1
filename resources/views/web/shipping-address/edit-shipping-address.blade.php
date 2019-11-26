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
								<li><a href="#" class="active">Edit Shipping Address</a></li>
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
							<h2>Edit Shipping Address</h2>
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
							@if (isset($shipping_address) && !empty($shipping_address))
								{{ Form::open(['method' => 'post','route'=>'web.shipping_address_update']) }}
								<input type="hidden" name="shipping_id" value="{{encrypt($shipping_address->id)}}">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Name <span class="required">*</span></label>
											<input type="text" name="name" placeholder="Enter Name" value="{{$shipping_address->name}}">
											@if($errors->has('name'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('name') }}</strong>
												</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<div class="checkout-form-list">
												<label>Email <span class="required">*</span></label>	
												<input type="email" name="email" placeholder="Enter Email" value="{{$shipping_address->email}}">
												@if($errors->has('email'))
													<span class="invalid-feedback" role="alert" style="color:red">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
												@enderror
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Mobile</label>
											<input type="number" placeholder="Enter Mobile Number" name="mobile" style="margin: -1px;" value="{{$shipping_address->mobile}}">
											@if($errors->has('mobile'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('mobile') }}</strong>
												</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list country-select">
											<label>Select State<span class="required">*</span></label>	
											<select name="state" id="state">
												<option value="">Select State</option>
												@if (isset($states) && !empty($states))
													@foreach ($states as $state)
														<option value="{{$state->id}}" {{ $shipping_address->state_id == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
													@endforeach
												@endif
											</select>
											@if($errors->has('state'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('state') }}</strong>
												</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list country-select">
											<label>Select City <span class="required">*</span></label>
											<select name="city" id="city">
												<option value="">Select City</option>
												@if (isset($city) && !empty($city))
													@foreach ($city as $cit)
														<option value="{{$cit->id}}" {{ $shipping_address->city_id == $cit->id ? 'selected' : '' }}>{{$cit->name}}</option>
													@endforeach
												@endif
											</select>
											@if($errors->has('city'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('city') }}</strong>
												</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Pin Code <span class="required">*</span></label>	
											<input type="text" placeholder="Enter Pin Code" name="pin" value="{{$shipping_address->pin}}">
											@if($errors->has('pin'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('pin') }}</strong>
												</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="checkout-form-list">
											<label>Address <span class="required">*</span></label>
										<textarea type="text" class="form-control" name="address">{{$shipping_address->address}}</textarea>
											@if($errors->has('address'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('address') }}</strong>
												</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flex-center ptb-20">
										<button class="btn btn-success" style="padding: 10px 30px;"> Submit </button>
									</div>																		
								</div>
								{{ Form::close() }}		
							@endif											
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
				</div>
			</div>
		</div>
		<!-- checkout-area-end -->
		@endsection