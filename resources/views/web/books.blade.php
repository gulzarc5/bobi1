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
								<li><a href="#" class="active">Books List</a></li>
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
										
										<div class="single-most-product bd mb-18">											
											<div class="most-product-content">												
												<h4><a href="{{route('web.new_book_list',['academic'=>encrypt(1)])}}">ACADEMIC</a></h4>
											</div>
										</div>

										<div class="single-most-product bd mb-18">											
											<div class="most-product-content">												
												<h4><a href="{{route('web.new_book_list',['academic'=>encrypt(2)])}}">NON-ACADEMIC</a></h4>
											</div>
										</div>

										<div class="single-most-product bd mb-18">											
											<div class="most-product-content">												
												<h4><a href="{{route('web.new_book_list_category',['category_id'=>encrypt(10)])}}">NOVELS</a></h4>
											</div>
										</div>

										<div class="single-most-product bd mb-18">											
											<div class="most-product-content">												
												<h4><a href="{{route('web.new_book_list_category',['category_id'=>encrypt(11)])}}">FAIRY TALE</a></h4>
											</div>
										</div>

										<div class="single-most-product bd mb-18">											
											<div class="most-product-content">												
												<h4><a href="{{route('web.new_book_list_category',['category_id'=>encrypt(12)])}}">POEMS</a></h4>
											</div>
										</div>
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
						<div class="section-title-5 mb-30" id="book_number">
							<h2>Books&nbsp; 
								{{-- @if (isset($book_total))
									({{$book_total}})
								@else
									(0)
								@endif --}}
							</h2>
						</div>

						<div class="toolbar mb-30">
							<input type="hidden" name="category_id" value="{{ isset($category_id)  ? $category_id : '' }}">
							<input type="hidden" name="book_type" value="{{ isset($book_type)  ? $book_type : '' }}">

							<div class="toolbar-sorter">
								<span>Language</span>
								<select name="language" id="language" onchange="getBook()" class="sorter-options" style="width:186px">
									<option value="" selected>All Languages</option>
									@if (isset($book_language) && count($book_language))
										@foreach ($book_language as $item)
											<option value="{{$item->id}}">{{$item->name}}</option>
										@endforeach
									@endif
								</select>
								<a href="#"><i class="fa fa-arrow-up"></i></a>
							</div>
							<div class="toolbar-sorter">
								<span>Book Title</span>
								<input type="text" onkeyup="getBook()" name="book_title" id="book_title" class="sorter-options" style="width:165px">
								<a href="#"><i class="fa fa-arrow-up"></i></a>
							</div>
							<div class="toolbar-sorter">
								<span>Publisher</span>
								<input type="text" name="publisher" onkeyup="getBook()" id="publisher" class="sorter-options" style="width:165px">
								<a href="#"><i class="fa fa-arrow-up"></i></a>
							</div>
						</div>

						<!-- tab-area-start -->
						<div class="tab-content book-list">
							<div class="tab-pane active" id="th">
							    <div class="row" id="pagination_data">
									@include('web.pagination.book_search')									
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
					var category = $("#category_id").val();
					var book_type = $("#book_type").val();
					var language = $("#language").val();
					var book_title = $("#book_title").val();
					var publisher = $("#publisher").val();
					var book_condition = "1";
					// alert(publisher);
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type:"POST",
						url:"{{ route('ajax_book_list') }}",
						data:{
							"_token": "{{ csrf_token() }}",
							category:category,
							book_type:book_type,
							language:language,
							book_title:book_title,
							publisher:publisher,
							book_condition:book_condition,
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
						url:"{{asset('Book/search/pagination?page=')}}"+page,
						success:function(data){
							console.log(data)
							$("#pagination_data").html(data);
						}
					});

				}
			</script>
		@endsection	