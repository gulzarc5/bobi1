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
					<h2>Edit User Detail</h2>
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
				<div class="checkbox-form">
					@if (isset($user_details) && !empty($user_details))
						{{ Form::open(['method' => 'post','route'=>'web.myProfileUpdate']) }}
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
									<label>Name <span class="required">*</span></label>								<input type="text" name="name" value="{{$user_details->name}}">
									@if($errors->has('name'))
										<span class="invalid-feedback" role="alert" style="color:red">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@enderror
								</div>
							</div>
							{{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-form-list">
									<label>Email <span class="required">*</span></label>										
								<input type="text" name="email" value="{{$user_details->email}}" >
								</div>
							</div> --}}
							{{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-form-list">
									<label>Mobile</label>
									<input type="number" name="mobile" value="{{$user_details->mobile}}" >
								</div>
							</div> --}}
							<div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top: 2px;">
								<div class="country-select">
									<label>Gender <span class="required">*</span></label>
									<select name="gender">
										<option value="">Select Gender</option>
										<option value="M" {{ $user_details->gender == 'M' ? 'selected' : '' }}>Male</option>
										<option value="F" {{ $user_details->gender == 'F' ? 'selected' : '' }}>Female</option>
									</select> 	
									@if($errors->has('gender'))
										<span class="invalid-feedback" role="alert" style="color:red">
											<strong>{{ $errors->first('gender') }}</strong>
										</span>
									@enderror									
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-form-list">
									<label>PAN Number <span class="required">*</span></label>
									<input type="text" name="pan" value="{{$user_details->pan}}">
									@if($errors->has('pan'))
										<span class="invalid-feedback" role="alert" style="color:red">
											<strong>{{ $errors->first('pan') }}</strong>
										</span>
									@enderror	
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="checkout-form-list">
									<label>Date Of Birth</label>
									<input type="date" name="dob" value="{{$user_details->dob}}">
									@if($errors->has('dob'))
										<span class="invalid-feedback" role="alert" style="color:red">
											<strong>{{ $errors->first('dob') }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<h5>User Address</h5>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="country-select">
									<label>Select State <span class="required">*</span></label>			
									<select name="state" id="state">
										<option value="">Select State</option>					
										@if (isset($states) && !empty($states))
											@foreach ($states as $state)
												<option value="{{$state->id}}" {{ $user_details->state_id == $state->id ? 'selected' : '' }}>{{$state->name}}</option>
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
								<div class="country-select">
									<label>Select City <span class="required">*</span></label>
									<select name="city" id="city">
										<option value="">Select City</option>
										@if (isset($city) && !empty($city))
											@foreach ($city as $cit)
												<option value="{{$cit->id}}" {{ $user_details->city_id == $cit->id ? 'selected' : '' }}>{{$cit->name}}</option>
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
									<label>Postcode / Zip <span class="required">*</span></label>
									<input type="number" value="{{$user_details->pin}}" name="pin" >
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
									<textarea type="text" class="form-control" name="address">{{$user_details->address}}</textarea>
								</div>
							</div>	
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<center><button class="btn btn-success"></i>&nbsp;&nbsp;Submit</button></center>
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