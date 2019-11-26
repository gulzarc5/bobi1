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
								<li><a href="#" class="active">Quiz View</a></li>
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
								{{-- Code --}}
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="product-info-main">
											<div class="page-title">
												<h1>{{$quiz_details->name}}</h1>
											</div>
											<div class="product-details flex-center quiz-content" style="justify-content: space-between;width: 100%;margin-bottom: 10px;border: none">                                                
							                    <h4><a>Catagory : {{$quiz_details->cat_name}}</a></h4>
							                    <h4><a>Total pages : {{$quiz_details->pages}}</a></h4>
							                </div>
										</div>
									</div>	
								{{-- Code --}}
							</div>	
						</div>
						<!-- product-main-area-end -->
						<!-- product-info-area-start -->
						<div class="product-info-area">
							<!-- Nav tabs -->
							<div class="tab-content" style="border-top: 1px solid #d1d1d1;">
                                <div class="tab-pane active" id="Details">
                                    <div class="valu">
                                      	<p>{!!$quiz_details->description!!}</p>
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
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- product-main-area-end -->
		<!-- footer-area-start -->
		@endsection