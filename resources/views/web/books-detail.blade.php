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
								<li><a href="#" class="active">Books Detail</a></li>
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

					@if (isset($book_detail) && !empty($book_detail))
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
							<!-- product-main-area-start -->
							<div class="product-main-area">
								<div class="row">
									<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
										<div class="flexslider">
											<img src="{{asset('images/book_image/'.$book_detail->book_image.'')}}">
										</div>
									</div>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
										<div class="product-info-main">
											<div class="page-title">
												<h1>{{$book_detail->book_name}}</h1>
												<h5>{{$book_detail->author_name}}</h5>
											</div>
											<div class="product-info-stock-sku">
												<span>Language:</span>
												<div class="product-attribute">
													<span>{{$book_detail->lang_name}}</span>
												</div>
											</div>
											<div class="product-info-stock-sku">
												<span>Publisher:</span>
												<div class="product-attribute">
													<span>{{$book_detail->publisher_name}}</span>
												</div>
											</div>
											<div class="product-reviews-summary">
												<div class="reviews-actions">
													<a>Academic</a>
													<a class="view">
														@if ($book_detail->book_type == '1')
															Academic
														@else
															Non-Academic
														@endif
													</a>
													<a class="view">{{$book_detail->cat_name}}</a>
													<a class="view">
														@if ($book_detail->book_condition == '1')
															New
														@else
															Old
														@endif
													</a>
												</div>
											</div>
											<div class="product-info-price">
												<div class="price-final">
													<span>₹ {{ number_format($book_detail->price,2,".",'')}}</span>
													<span class="old-price">₹{{ number_format($book_detail->mrp,2,".",'')}}</span>
												</div>
											</div>
											<div class="product-add-form">
												<form action="#">
													<a href="{{route('web.add_cart',['book_id'=>encrypt($book_detail->id)])}}">Add to cart</a>
												</form>
											</div>
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
										<p>{{$book_detail->description}}</p>
										</div>
									</div>
								</div>	
							</div>
							<!-- product-info-area-end -->
						</div>
					@endif

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
									<li><a href="{{route('web.megazine_list')}}">&nbsp;&nbsp;Magazines
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