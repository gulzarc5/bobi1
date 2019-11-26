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
				<div class="row">						
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="checkbox-form mb-25">
							<div class="product-info-area">
								<div class="tab-content">
	                                <div class="tab-pane active" id="Books">
	                                    <div class="row valu" style="margin-bottom: 20px ">
		                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                                      		<img src="{{asset('images/megazines/thumb/'.$megazine[0]->cover_image.'')}}">
		                                    </div>
	                                      	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
	                                      		<div class="order-content">
	                                      			<h4>{{ $megazine[0]->name }}</h4>
	                                      			<div class="flex" style="justify-content: space-between;width: 100%;">
	                                      				<p>Total Pages : <span>{{ $megazine[0]->pages }}</span></p>
	                                      			</div>
	                                      			<div class="price-final mb-10">
														Total : <span>₹ {{ $megazine[0]->cost }}</span>
													</div>
	                                      		</div>
	                                      	</div>
	                                    </div>
	                                </div>
	                            </div>	
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="checkbox-form mb-25">
							<h5 style="text-align: center;">Checkout Amount</h5>
							<div class="row">
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
									Total
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									₹ {{ $megazine[0]->cost }}
								</div>	
							</div>	
							<div class="bdr"></div>
							<div class="row">									
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
									<strong>Grand Total</strong>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-10">
									<strong>₹ {{ $megazine[0]->cost }}</strong>
								</div>	
								<div style="margin: auto;display: table;">									
									<a href="{{ route('megazine_pay', ['megazine_id' => $megazine[0]->id]) }}"><button class="btn btn-success">Proceed To Pay</button></a>
								</div>		
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- checkout-area-end -->
		@endsection