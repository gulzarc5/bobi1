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
								<li><a href="#" class="active">Add Shipping Address</a></li>
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
							<h2>Add Shipping Address</h2>
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
							{{ Form::open(['method' => 'post','route'=>'web.add_checkout_insert_address']) }}
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Name <span class="required">*</span></label>
											<input type="text" name="name" placeholder="Enter Name" value="{{old('name')}}">
											@if($errors->has('name'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('name') }}</strong>
												</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Email <span class="required">*</span></label>	
											<input type="email" name="email" placeholder="Enter Email" value="{{old('email')}}">
											@if($errors->has('email'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('email') }}</strong>
												</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="checkout-form-list">
											<label>Mobile</label>
											<input type="number" placeholder="Enter Mobile Number" name="mobile" style="margin: -1px;" value="{{old('mobile')}}">
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
														<option value="{{$state->id}}">{{$state->name}}</option>
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
												<input type="text" placeholder="Enter Pin Code" name="pin" value="{{old('pin')}}">
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
										<textarea type="text" class="form-control" name="address">{{old('address')}}</textarea>
											@if($errors->has('pin'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('pin') }}</strong>
												</span>
											@enderror
										</div>
									</div>
									
									
									
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flex-center ptb-20">
										<button type="submit" class="btn btn-success" style="padding: 10px 30px;"> Submit </button>
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

		@section('script')
<script type="text/javascript">
	var color_html = null;
	 var size={};
	$(document).ready(function(){
		$("#state").change(function(){
			var state = $(this).val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type:"GET",
				url:"{{ url('City/list')}}"+"/"+state+"",
				success:function(data){
					$("#city").html("<option value=''>Please Select City</option>");

					$.each( data, function( key, value ) {
						$("#city").append("<option value='"+key+"'>"+value+"</option>");
					});
				}
			});
		});
	});

</script>
@endsection