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
								<li><a href="#" class="active">Shipping Address</a></li>
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
							<h2>Shipping Address</h2>
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
		<div class="checkout-area select-add mb-70">
			<div class="container">
				<div class="row">						
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						@if (isset($shipping_address) && count((array)$shipping_address) > 0)
							@foreach ($shipping_address as $item)
								<div class="checkbox-form mb-25">
									<div class="row">
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 p-0">
											<div class="row" style="padding: 8px 0;">
												<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 icon-content">
													<img src="{{asset('web/img/icons/home.png')}}">
												</div>
												<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
													<h4>{{$item->name}}</h4>
													<p>{{$item->address}}</p>
													<p>{{$item->c_name}}, {{$item->s_name}}-{{$item->pin}}</p>
													<p>{{$item->mobile}}</p>
													<p>{{$item->email}}</p>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="checkout-form-list">
												<a href="{{route('web.shipping_address_delete',['shipping_id'=>encrypt($item->id)])}}"><button class="btn btn-danger">Delete</button></a>
												<a href="{{route('web.shipping_address_edit',['shipping_id'=>encrypt($item->id)])}}"><button class="btn btn-info">Edit</button></a>
											</div>
										</div>																	
									</div>												
								</div>
							@endforeach
						@endif
						
						{{-- <div class="checkbox-form mb-25">
							<div class="row">
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 p-0">
									<div class="row" style="padding: 8px 0;">
										<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 icon-content">
											<img src="{{asset('web/img/icons/home.png')}}">
										</div>
										<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
											<h4>Rahul Roy</h4>
											<p>56/1, Fake Street, Bogus Place</p>
											<p>City, State</p>
											<p>9458678145</p>
											<p>demo@example.com</p>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="checkout-form-list">
										<a href="#"><button class="btn btn-danger">Delete</button></a>									
										<a href="{{route('web.shipping-address.edit-shipping-address')}}"><button class="btn btn-info">Edit</button></a>
									</div>
								</div>																	
							</div>												
						</div>						 --}}
						<div class="checkbox-form mb-25 ptb-20">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>	
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flex-center">
									<a href="{{route('web.shipping_address_form')}}"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add More</button></a>
								</div>	
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
							</div>												
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
				</div>
			</div>
		</div>
		<!-- checkout-area-end -->
		@endsection