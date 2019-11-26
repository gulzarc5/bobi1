		@extends('web.template.master')
		<!-- Head & Header Section -->
		@section('content') 
				<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area breadcrumbs-area-mobile mb-10">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#" class="active">Magazines List</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- shop-main-area-start -->
		<div class="shop-main-area mb-70">
			<div class="container">
				<div class="row">
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
							
							<div class="left-title mb-20">
								<h4>Categories</h4>
							</div>
							<div class="random-area mb-30">
								<div class="product-active-2 owl-carousel">
									<div class="product-total-2">
										@if(count($category) > 0)
											@foreach($category as $key => $value)
												<div class="single-most-product bd mb-18">
											
													<div class="most-product-content">
														
														<h4><a href="{{route('web.megazine_list_category',['category_id'=>encrypt($value->id)])}}">{{ $value->name }}</a></h4>
													</div>
												</div>
											@endforeach
										@endif
									</div>										
								</div>
							</div>
							<div class="banner-area mb-30">
								<div class="banner-img-2">
									<a href="#"><img src="{{asset('web/img/banner/31.jpg')}}" alt="banner" /></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
						<div class="category-image mb-30">
							<a href="#"><img src="{{asset('web/img/banner/32.jpg')}}" alt="banner" /></a>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="section-title-5 mb-10">
									<h2>Magazine&nbsp;</h2>
								</div>
							</div>
							<div class="col-md-6">
								<div class="header-search">
									<a href="#"><i class="fa fa-search"></i></a>
									<input type="text" placeholder="Search Megazine here..." onkeyup="getBook()" name="megazine_search_box" id="megazine_search_box">
								</div>
							</div>	
						</div><hr>
						<!-- tab-area-start -->
						<div class="tab-content book-list">
							<div class="tab-pane active" id="th">
							    <div class="row" id="pagination_data">
							        @include('web.pagination.megazine_search')
							        
							    </div>
							</div>
						</div>
						<!-- tab-area-end -->
					</div>
				</div>
			</div>
		</div>
		<!-- shop-main-area-end -->
		<!-- footer-area-start -->
		@endsection

		@section('script')
	<script>
		function getBook() {
			var megazine_search_value= $("#megazine_search_box").val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type:"POST",
				url:"{{ route('ajax_megazine_list') }}",
				data:{
					"_token": "{{ csrf_token() }}",
					megazine_search_value:megazine_search_value
				},
				beforeSend: function() {
					// setting a timeout
					$("#pagination_data").html('<i class="fa fa-spinner fa-spin loader-spin"></i>');
				},
				success:function(data){
					$("#pagination_data").html(data);
				}
			});
		}

		$(document).ready(function () {
			$(document).on('click','.pagination a',function(event){
				event.preventDefault();
				var page = $(this).attr('href').split('page=')[1];
				fetchData(page);
			});
		});

		function fetchData(page) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type:"GET",
				url:"{{asset('megazine/Ajax/Megazine/List?page=')}}"+page,
				success:function(data){
					console.log(data)
					$("#pagination_data").html(data);
				}
			});

		}
	</script>
@endsection	