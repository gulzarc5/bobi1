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
								<li><a href="#" class="active">My Orders</a></li>
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
							<h2>My Orders</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- entry-header-area-end -->
		<!-- checkout-area-start -->
		<div class="checkout-area select-add orders mb-70">
			<div class="container">
				<div class="row">						
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="checkbox-form mb-25">
							<div class="product-info-area">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs pb-10" role="tablist">
									<li class="ntab {{ $status == 1 ? 'active' : '' }}"><a href="#Books" data-toggle="tab" aria-expanded="true">Books</a></li>
									<li class="ntab {{ $status == 2 ? 'active' : '' }}"><a href="#Project" data-toggle="tab" aria-expanded="false">Projects</a></li>
									<li class="ntab {{ $status == 3 ? 'active' : '' }}"><a href="#Magazine" data-toggle="tab" aria-expanded="false">Magazines</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane {{ $status == 1 ? 'active' : '' }}" id="Books">
										@if (isset($book_orders) && !empty($book_orders))
											@foreach ($book_orders as $item)
												<div class="row valu" style="margin-bottom: 20px ">
													<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
														  <img src="{{asset('images/book_image/thumb/'.$item->book_image.'')}}">
													</div>
													  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
														  <div class="order-content">
															  <h4>{{$item->book_name}}</h4>
															  <div class="price-final mb-10">
																<span>₹ {{ number_format($item->price,2,".",'')}}</span>
															</div>
															<div class="status" style="display:flex;justify-content:space-between">
																
																	<div>
																		@if ($item->status == 1)
																			<h6 class="pen">Pending</h6>
																		@elseif($item->status == 2)
																			<h6 class="del">Dispatched</h6>
																		@elseif($item->status == 3)
																			<h6 class="del">Delivered</h6>
																		@elseif($item->status == 4)
																			<h6 class="can">Canceled</h6>
																		@else
																			<h6 class="can">Return</h6>
																		@endif		
																	</div>
																	<div>
																		Payment Status : 
																		@if ($item->payment_status == 2)
																			<h6 class="can">Pending</h6> 
																		@else
																			<h6 class="del">Paid</h6>
																		@endif
																		
																	</div>
																

															</div>
															<div class="flex" style="justify-content: space-between;width: 100%">
																<p>Order ID : <span>{{$item->id}}</span></p>
																<p>Order On : <span>{{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString()}}</span></p>
															</div>
															@if ($item->status == 2)
															<div class="flex" style="justify-content:center;width: 100%">
																<a href="https://track.aftership.com/" target="_blank" style="background-color:cornflowerblue">Click Here To Track Order</a>
															</div>
																<div class="flex" style="justify-content: space-between;width: 100%; font-weight:bold">
																	<p> Courier Name : <span>{{$item->courier_name}}</span></p>	
																	<p>Consignment Number  : <span>{{$item->consighment_no}}</span></p>															
																</div>
															@endif
															
														  </div>
													  </div>
												</div>
											@endforeach
										@else
											
										@endif
	                                </div>
	                                <div class="tab-pane {{ $status == 2 ? 'active' : '' }}" id="Project">
	                                	@if(count($project_orders) > 0)
	                                		@foreach($project_orders as $key => $value)
	                                			<div class="row valu" style="margin-bottom: 20px ">
				                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			                                      		<img src="{{asset('web/img/icons/4.png')}}">
				                                    </div>
			                                      	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
			                                      		<div class="order-content">
			                                      			<h4>{{ $value->name }}</h4>
			                                      			<div class="price-final mb-10">
																<span>₹ {{ $value->price }}</span>
															</div>
															<div class="status" style="display:flex;justify-content:space-between">
																<div>
																	Payment Status : 
																	@if ($value->payment_status == 2)
																		<h6 class="can">Pending</h6> 
																	@else
																		<h6 class="del">Paid</h6>
																	@endif					
																</div>
																<div>
																	Order On :<span>{{ \Carbon\Carbon::parse($value->created_at)->toDayDateTimeString()}}</span>
																	
																</div>
															</div>
			                                      			<div class="flex" style="justify-content: space-between;width: 100%">
			                                      				<p>Order ID : <span>{{ $value->id }}</span></p>
			                                      				<p><a href="{{route('web.project_detail', ['project_id' => encrypt($value->project_id)])}}" title="View Project" class="btn btn-primary margin-mobile" style="background: steelblue;
																	border: steelblue;">View</a></p>
			                                      			</div>
			                                      		</div>
			                                      	</div>
			                                    </div>
	                                		@endforeach
	                                	@endif
	                                </div>
	                                <div class="tab-pane {{ $status == 3 ? 'active' : '' }}" id="Magazine">
	                                    @if(count($megazine_orders) > 0)
	                                		@foreach($megazine_orders as $key => $value)
	                                			<div class="row valu" style="margin-bottom: 20px ">
				                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			                                      		<img src="{{asset('images/megazines/thumb/'.$value->cover_image.'')}}">
				                                    </div>
			                                      	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
			                                      		<div class="order-content">
			                                      			<h4>{{ $value->name }}</h4>
			                                      			<div class="price-final mb-10">
																<span>₹ {{ $value->price }}</span>
															</div>
															<div class="status" style="display:flex;justify-content:space-between">
																{{-- <div>
																	<h6 class="del">Delivered</h6>
																</div> --}}
																<div>
																	Payment Status : 
																	@if ($value->payment_status == 2)
																		<h6 class="can">Pending</h6> 
																	@else
																		<h6 class="del">Paid</h6>
																	@endif
																		
																</div>
															</div>
			                                      			<div class="flex" style="justify-content: space-between;width: 100%">
			                                      				<p>Order ID : <span>{{ $value->id }}</span></p>
																  <p>Order On : <span>{{ \Carbon\Carbon::parse($value->created_at)->toDayDateTimeString()}}</span></p>
																  <p><a href="{{route('web.megazine_detail', ['project_id' => encrypt($value->megazine_id)])}}" title="View Project" class="btn btn-primary margin-mobile" style="background: steelblue;
																	border: steelblue;">View</a></p>
			                                      			</div>
			                                      		</div>
			                                      	</div>
			                                    </div>
	                                		@endforeach
	                                	@endif
	                                </div>
	                            </div>	
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
				</div>
			</div>
		</div>
		<!-- checkout-area-end -->
		@endsection