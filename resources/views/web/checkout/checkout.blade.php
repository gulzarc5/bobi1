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
								<li><a href="#" class="active">Checkout</a></li>
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
							<h2>Checkout</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- checkout-area-start -->
		<div class="checkout-area select-add orders mb-70">
			<div class="container">
				{{ Form::open(['method' => 'post','route'=>'web.book_order_place']) }}
					<div class="row">						
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<div class="checkbox-form mb-25">
								<h5 style="text-align: center;">Shipping Address</h5>
								
								<div class="row">
									@if (isset($shipping_address) && !empty($shipping_address))
										@php
											$count_ship = 1;
										@endphp
										@foreach ($shipping_address as $addr)
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-10">
												<div class="row" style="background-color: #fff;border:1px solid #ddd">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
														<div class="row" style="padding: 8px 0;">
															<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 icon-content">
																@if (count((array)$shipping_address) == $count_ship)
																	<input type="radio" name="shipping_id" value="{{$addr->id}}" checked>
																@else
																	<input type="radio" name="shipping_id" value="{{$addr->id}}" >
																@endif
															
															</div>
															<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
																<h4>{{$addr->name}}</h4>
																<p>{{$addr->address}}</p>
																<p>{{$addr->c_name}}, {{$addr->s_name}}-{{$addr->pin}}</p>
																<p>{{$addr->mobile}}</p>
																<p>{{$addr->email}}</p>
															</div>
														</div>
													</div>																	
												</div>									
											</div>
											@php
												$count_ship++;
											@endphp
										@endforeach				
									@endif
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-10">
										<div class="add-addrs">
											<a href="{{route('web.add_checkout_address')}}"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add More</button></a>
										</div>	
									</div>
								</div>									
							</div>
						</div>
						
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								@if (isset($cart) && !empty($cart))
									<div class="checkbox-form mb-25">
										<h5 style="text-align: center;">Cart Amount</h5>
										<div class="row">
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												Sub Total ({{ $cart->total_quantity }} items)
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												₹ {{ number_format($cart->total_cart_amount,2,".",'')}}
											</div>	
											{{-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												GST
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
												₹ 14.00
											</div> --}}
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												Shipping Charge
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
												@if ($cart->total_shipping_charge > 0)
													₹ {{ number_format($cart->total_shipping_charge,2,".",'')}}
												@else
													Free
												@endif												
											</div>
										</div>	
										<div class="bdr"></div>
										<div class="row">									
											<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
												<strong>Grand Total</strong>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-10">
												<strong>₹ {{ number_format(($cart->total_shipping_charge+$cart->total_cart_amount),2,".",'')}}</strong>
											</div>			
										</div>
									</div>
								@endif
								<div class="checkbox-form mb-25">
									<h5 style="text-align: center;">Payment Method</h5>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flex mb-10" style="justify-content: space-around;">
											<div class="form-check">
												<input class="form-check-input" type="radio" name="payment_method" id="exampleRadios1" value="1" checked>
												<label class="form-check-label" for="exampleRadios1">
													COD
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="payment_method" id="exampleRadios2" value="2">
												<label class="form-check-label" for="exampleRadios2">
												CARD PAYMENT
												</label>
											</div>
										</div>	
										<div style="margin: auto;display: table;">									
											<a href="#"><button class="btn btn-success">Proceed To Pay</button></a>
										</div>
									</div>
								</div>
							</div>
						

					</div>
				{{ Form::close() }}
			</div>
		</div>
		<!-- checkout-area-end -->
		@endsection