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
								<li><a href="#" class="active">Project Detail</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- product-main-area-start -->
		<div class="product-main-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
						<!-- product-main-area-start -->
						<div class="product-main-area">
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
									<div class="flexslider">
										<img src="{{asset('web/img/icons/4.png')}}">
									</div>
								</div>
								<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
									<div class="product-info-main">
										<div class="page-title">
											<h1>{{ $project[0]->name }}</h1>
											<h5>Specialisation : {{ $project[0]->ps_name }}</h5>
										</div>
										{{-- <div class="product-info-stock-sku">
                                            <span>Project ID : </span>
                                            <div class="product-attribute">
                                                 <span>CHIN124</span>
                                            </div>
                                        </div> --}}
										<div class="product-info-stock-sku">
											<span>Total Pages : </span>
											<div class="product-attribute">
												<span>{{ $project[0]->pages }}</span>
											</div>
										</div>
										<div class="product-reviews-summary">
											<div class="reviews-actions">
												<a><strong>Package Includes :</strong></a>
												<a> 
													@if (!empty($project[0]->preview))
														Preview/
													@endif													
													@if (!empty($project[0]->synopsis))
														Synopsis/
													@endif
													@if (!empty($project[0]->documentation))
														Documentation/
													@endif							
													@if (!empty($project[0]->ppt))
														PPT
													@endif
												</a>
											</div>
										</div>
										<div class="product-info-feature">
											@if (!empty($project[0]->preview))
												<div class="inclues">
													<i class="fa fa-check-square-o" aria-hidden="true"></i>Preview <a href="{{ route('web.project_preview', ['project_id' => encrypt($project[0]->id)]) }}" target="_blank"> View</a>
												</div>
											@endif
											@auth('buyer')
												@if ($purchase_status == 2)
													@if (!empty($project[0]->synopsis))
														<div class="inclues">
															<i class="fa fa-check-square-o" aria-hidden="true"></i>Synopsis <a href="{{ route('web.project_synopsis', ['project_id' => encrypt($project[0]->id)]) }}" target="_blank"> View</a>
														</div>
													@endif
													@if (!empty($project[0]->documentation))
														<div class="inclues">
															<i class="fa fa-check-square-o" aria-hidden="true"></i>Documentation <a href="{{ route('web.project_documentation', ['project_id' => encrypt($project[0]->id)]) }}" target="_blank"> View</a>
														</div>
													@endif							
													@if (!empty($project[0]->ppt))
														<div class="inclues">
															<i class="fa fa-check-square-o" aria-hidden="true"></i>PPT <a href="{{ route('web.project_ppt', ['project_id' => encrypt($project[0]->id)]) }}" target="_blank"> View</a>
														</div>
													@endif
												@endif
											@endauth
										</div>
										<div class="product-info-price">
											<div class="price-final">
												<span>₹ {{ $project[0]->cost }}</span>
											</div>
										</div>
										@if ($purchase_status == 1)
											<div class="product-add-form">
												<form action="#">
													<a href="{{ route('web.checkout_project', ['project_id' => encrypt($project[0]->id)]) }}">Proceed To Checkout</a>
												</form>
											</div>
										@endif
									</div>
								</div>
							</div>	
						</div>
						<!-- product-main-area-end -->
						<!-- product-info-area-start -->
						<div class="product-info-area">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li class="active"><a href="#Details" data-toggle="tab">DESCRIPTION</a></li>
							</ul>
							<div class="tab-content">
                                <div class="tab-pane active" id="Details">
                                    <div class="valu">
											{{ $project[0]->description }}
                                    </div>
                                </div>
                            </div>	
						</div>
						<!-- product-info-area-end -->
					</div>
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 mobile-side">
						<div class="shop-left">
							<div class="section-title-5 mb-30">
								<h2>Shopping Options</h2>
							</div>
							<div class="left-menu mb-30">
								<ul>
									<li><a href="{{route('web.new_book_list')}}">&nbsp;&nbsp;New Books
										<span>
											@if (isset($new_books_count))
												({{$new_books_count}})
											@else
												(0)
											@endif
										</span>
									</a></li>	
									<li><a href="{{route('web.old_book_list')}}">&nbsp;&nbsp;Old Books
										<span>
											@if (isset($old_books_count))
												({{$old_books_count}})
											@else
												(0)
											@endif
										</span>
									</a></li>									
									<li><a href="{{route('web.project_list')}}">&nbsp;&nbsp;Projects
										<span>
											@if (isset($projects_count))
												({{$projects_count}})
											@else
												(0)
											@endif
										</span>
									</a></li>
									<li><a href="megazine.php">&nbsp;&nbsp;Magazines
										<span>
											@if (isset($megazines_count))
												({{$megazines_count}})
											@else
												(0)
											@endif
										</span>
									</a></li>
									<li><a href="{{route('web.quiz_list')}}">&nbsp;&nbsp;Quiz
										<span>
											@if (isset($quiz_count))
												({{$quiz_count}})
											@else
												(0)
											@endif
										</span>
									</a></li>
								</ul>
							</div>
							<div class="banner-area mb-30">
								<div class="banner-img-2">
									<a href="#"><img src="{{asset('web/img/banner/31.jpg')}}" alt="banner" /></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- product-main-area-end -->
		<!-- footer-area-start -->
		@endsection