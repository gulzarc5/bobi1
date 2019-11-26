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
								<li><a href="#" class="active">Cart</a></li>
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
							<h2>Cart</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- checkout-area-start -->
		<div class="checkout-area select-add cart orders mb-70">
			<div class="container">
				<div class="row">	
					@if (isset($cart_data) && !empty($cart_data) && count((array)$cart_data) > 0)					
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="checkbox-form mb-25">
							<div class="product-info-area">
								<div class="tab-content">
	                                <div class="tab-pane active" id="Books">
										@php
											$cart_amount = 0;
											$shipping_charge = 0;
											$total_item = 0;
										@endphp
										
											
											@foreach ($cart_data as $item)
												<div class="row valu" style="margin-bottom: 20px ">
													<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
														  <img src="{{asset('images/book_image/thumb/'.$item->book_image.'')}}">
													</div>
													<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
														<div class="order-content">
															<h4>{{$item->book_name}}</h4>
															<div class="flex" style="justify-content: space-between;width: 100%;">
																<p>Author : <span>{{$item->author_name}}</span></p>
																<p>Publisher : <span>{{$item->publisher_name}}</span></p>
															</div>															
															{{ Form::open(['method' => 'post','route'=>'web.updateCart']) }}
																<div class="flex" style="justify-content: space-between;width: 100%;">
																  	<div class="price-final mb-10">
																		Rate: <span>₹ {{ number_format($item->price,2,".",'')}}</span>
																	</div>
																	<div class="quantity">
																		<input type="hidden" name="book_id" value="{{encrypt($item->id)}}">
																		<div class="price-final mb-10">
																			Quantity : <span><input type="number" min="1" name="quantity" value="{{$item->quantity}}"></span>
																		</div>	
																	</div>
																	<div class="price-final mb-10">
																		Total: <span>₹ {{ number_format(floatval($item->quantity) * floatval($item->price),2,".",'')}}</span>
																	</div>
																</div>
																<button type="submit">Update Item</button>
																<a href="{{route('cartItemRemove',['book_id'=>encrypt($item->id)])}}" class="btn btn-danger">Remove item</a>
															{{ Form::close() }}	
														</div>
													</div>
												</div>
												@php
													$cart_amount += (floatval($item->quantity) * floatval($item->price));
													$shipping_charge += $item->shipping_charge;
													$total_item++;
												@endphp
											@endforeach
																			

	                                </div>
	                            </div>	
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="checkbox-form mb-25">
							<h5 style="text-align: center;">Cart Amount</h5>
							<div class="row">
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
									Sub Total ({{$total_item}} items)
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									₹ {{ number_format($cart_amount,2,".",'')}}
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
									@if ($shipping_charge > 0)
										₹ {{ number_format($shipping_charge,2,".",'')}}
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
									<strong>₹ 
										@php
											$grand_total = $cart_amount+$shipping_charge;
										@endphp
										{{$grand_total}}
									</strong>
								</div>
								<div style="margin: auto;display: table;">									
									<a href="{{route('web.checkout_book')}}"><button class="btn btn-success">Proceed To Checkout</button></a>
								</div>			
							</div>
						</div>
					</div>
					@else
						<h1 style="display: flex;justify-content: center;">Cart Is Empty</h1>
					@endif	

				</div>
			</div>
		</div>
		<!-- checkout-area-end -->
		@endsection