		@extends('web.template.master')
		<!-- Head & Header Section -->
		@section('content') 
		<!-- slider-area-start -->
		<div class="slider-area">
			<div class="slider-active owl-carousel">
                <div class="single-slider slider-h1-2 pt-90 pb-100 bg-img" style="background-image:url({{asset('web/img/slider/2.jpg')}});">
                    <div class="container">
                        <div class="slider-content slider-content-2 slider-animated-1">
                            <h1>We can help get your</h1>
                            <h2 style="text-align: left;">Books in Order</h2>
                            <h3>and Accessories</h3>
                            <a href="{{route('web.thankyou.contact')}}">Contact Us Today!</a>
                        </div>
                    </div>
                </div>
				<div class="single-slider pt-90 pb-100 bg-img new-pos1" style="background-image:url({{asset('web/img/slider/1.jpg')}});">
				    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="slider-content slider-content-2 slider-animated-1 text-center">
                                    <h1>Huge Sale</h1>
                                    <h2>Projects</h2>
                                    <h3>Now starting at RS.99.00</h3>
                                    <a href="{{route('web.project_list')}}">Shop now</a>
                                </div>
                            </div>
                        </div>
				    </div>
				</div>
                <div class="single-slider pt-90 pb-100 bg-img new-pos" style="background-image:url({{asset('web/img/slider/3.jpg')}});">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="slider-content slider-content-2 slider-animated-1 text-center">
                                    <h1>Huge Sale</h1>
                                    <h2>Magazines</h2>
                                    <h3>Now starting at RS.99.00</h3>
                                    <a href="{{route('web.megazine_list')}}">Shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- slider-area-end -->
		<!-- banner-area-end -->
        <div class="banner-area-4 hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                        <div class="banner-img-2 mt-30">
                            <a href="{{route('web.new_book_list',['academic'=>encrypt(1)])}}"><img src="{{asset('web/img/banner/14.jpg')}}" alt="banner"></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="banner-total mt-30">
                            <div class="single-banner-7 xs-mb">
                                <div class="banner-img-2">
                                    <a href="{{route('web.new_book_list',['academic'=>encrypt(2)])}}"><img src="{{asset('web/img/banner/15.jpg')}}" alt="banner"></a>
                                </div>
                            </div>
                            <div class="single-banner-3 col-xs-12">
                                <div class="banner-img-2">
                                    <a href="{{route('web.new_book_list_category',['category_id'=>encrypt(10)])}}"><img src="{{asset('web/img/banner/16.jpg')}}" alt="banner"></a>
                                </div>
                            </div>
                        </div>
                        <div class="banner-total-2">
                            <div class="single-banner-4 hidden-xs">
                                <div class="banner-img-2">
                                    <a href="{{route('web.new_book_list_category',['category_id'=>encrypt(15)])}}"><img src="{{asset('web/img/banner/17.jpg')}}" alt="banner"></a>
                                </div>
                            </div>
                            <div class="single-banner-5">
                                <div class="banner-img-2">
                                    <a href="{{route('web.new_book_list_category',['category_id'=>encrypt(8)])}}"><img src="{{asset('web/img/banner/18.jpg')}}" alt="banner"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- product-area-start -->
		<!-- product-area-start -->
		<div class="product-area xs-mb pt-25">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title text-center mb-50">
							<h2>New Arrival Books</h2>
							<p>Browse the collection of our best selling and top interresting products. <br /> You definitely find what you are looking for..</p>
						</div>
					</div>
				</div>
                <!-- tab-area-start -->
                @if (isset($new_books) && !empty($new_books))
                    <div class="tab-content">
                        <div class="tab-pane active" id="Audiobooks">
                            <div class="tab-active owl-carousel">
                                <!-- single-product-start -->
                                @foreach ($new_books as $item)
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="{{route('web.books-detail',['book_id'=>encrypt($item->id)])}}">
                                                <img src="{{asset('images/book_image/thumb/'.$item->book_image.'')}}" alt="book" class="primary" />
                                            </a>
                                            {{-- <div class="product-flag">
                                                <ul>
                                                    <li><span class="sale">new</span></li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                        <div class="product-details text-center">
                                            {{-- <div class="product-rating">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div> --}}
                                            <h4><a class="semi-name" href="{{route('web.books-detail',['book_id'=>encrypt($item->id)])}}">J{{$item->book_name}}</a></h4>
                                            <div class="product-price">
                                                <ul>
                                                    <li>₹ {{ number_format($item->price,2,".",'')}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-link">
                                            <div class="product-button">
                                                <a href="{{route('web.books-detail',['book_id'=>encrypt($item->id)])}}" class="btn btn-primary margin-mobile">View</a>
                                            </div>                              
                                        </div>	
                                    </div>
                                @endforeach
                               
                                
                            </div>
                        </div>
                    </div>
                @endif
				<!-- tab-area-end -->
			</div>
		</div>
		<!-- product-area-end -->
        <!-- team-area-start -->
        <div class="team-area pt-25" style="padding-bottom: 0px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-50">
                            <h2>Our Products</h2>
                            <p>Browse the collection of our top catagory of products. <br /> You definitely find what you are looking for..</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 hidden-sm col-xs-12"></div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                        <div class="single-team">
                            <div class="team-img-area">
                                <div class="team-img">
                                    <a href="{{route('web.new_book_list',['book_condition'=>encrypt(1)])}}"><img src="{{asset('web/img/icons/1.png')}}" alt="man" /></a>
                                </div>
                            </div>
                            <div class="team-content text-center">
                                <h3>Books</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                        <div class="single-team mrg-none-xs">
                            <div class="team-img-area">
                                <div class="team-img">
                                    <a href="{{route('web.project_list')}}"><img src="{{asset('web/img/icons/4.png')}}" alt="man" /></a>
                                </div>
                            </div>
                            <div class="team-content text-center">
                                <h3>Projects</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                        <div class="single-team">
                            <div class="team-img-area">
                                <div class="{{route('web.megazine_list')}}">
                                    <a href="megazine.php"><img src="{{asset('web/img/icons/3.png')}}" alt="man" /></a>
                                </div>
                            </div>
                            <div class="team-content text-center">
                                <h3>Megazines</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                        <div class="single-team">
                            <div class="team-img-area">
                                <div class="team-img">
                                    <a href="{{route('web.quiz_list')}}"><img src="{{asset('web/img/icons/2.png')}}" alt="man" /></a>
                                </div>
                            </div>
                            <div class="team-content text-center">
                                <h3>Quiz</h3>
                                <!-- <span>Marketer</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team-area-end -->
		<!-- banner-area-start -->
		<div class="banner-area-5 mtb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="banner-img-2">
							<a><img style="height: 200px" src="{{asset('web/img/banner/5.jpg')}}" alt="banner" /></a>
							<div class="banner-text">
								<h3>G. Meyer Books & Spiritual Traveler Press</h3>
								<h2>Sale up to 30% off</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- banner-area-end -->
		<!-- bestseller-area-start -->
		<div class="bestseller-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<div class="bestseller-content">
							<h1>Author best selling</h1>
							<h2>Edujiyaan</h2>
							<p class="categories">categories:<a href="#">Books</a> , <a href="#">Megazines</a></p>
							<p style="text-align: justify-all;">We offer huge collection of books in diverse category of Fiction, Non-fiction, Biographies, History, Religions, Self -Help, Children. We also sell in vast collection of Investments and Management, Computers, Engineering, Medical, College and School text references books proposed by different institutes as syllabus across the country. Besides to this, we also offer a large collection of E-Books at very fair pricing.</p>
							<div class="social-author">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="banner-img-2">
							<a><img src="{{asset('web/img/banner/6.jpg')}}" alt="banner" /></a>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="row" style="padding-top: 21px;">
							<div class="col-md-6 col-xs-6">
                                <div class="single-bestseller mb-25">
                                    <div class="bestseller-img">
                                        <a href="{{route('web.new_book_list',['book_condition'=>encrypt(1)])}}"><img src="{{asset('web/img/book.jpg')}}" alt="book"></a>
                                        <div class="product-flag">
                                            <ul>
                                                <li><span class="sale">new</span></li>
                                                <!-- <li><span class="discount-percentage">-5%</span></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bestseller-text text-center">
                                        <h3> <a href="{{route('web.new_book_list',['book_condition'=>encrypt(1)])}}">Books</a></h3>
                                    </div>
                                </div>                     
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="single-bestseller mb-25">
                                    <div class="bestseller-img">
                                        <a href="{{route('web.megazine_list')}}"><img src="{{asset('web/img/megazine.jpg')}}" alt="megazine"></a>
                                        <div class="product-flag">
                                            <ul>
                                                <li><span class="sale">new</span></li>
                                                <!-- <li><span class="discount-percentage">-5%</span></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bestseller-text text-center">
                                        <h3> <a href="{{route('web.megazine_list')}}">Megazines</a></h3>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="single-bestseller mb-25">
                                    <div class="bestseller-img">
                                        <a href="{{route('web.project_list')}}"><img src="{{asset('web/img/project.jpg')}}" alt="project"></a>
                                        <div class="product-flag">
                                            <ul>
                                                <li><span class="sale">new</span></li>
                                                <!-- <li><span class="discount-percentage">-5%</span></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bestseller-text text-center">
                                        <h3> <a href="{{route('web.project_list')}}">Projects</a></h3>
                                    </div>
                                </div>                     
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="single-bestseller mb-25">
                                    <div class="bestseller-img">
                                        <a href="{{route('web.quiz_list')}}"><img src="{{asset('web/img/document.jpg')}}" alt="document"></a>
                                        <div class="product-flag">
                                            <ul>
                                                <li><span class="sale">new</span></li>
                                                <!-- <li><span class="discount-percentage">-5%</span></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bestseller-text text-center">
                                        <h3> <a href="{{route('web.quiz_list')}}">Documents</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<!-- bestseller-area-end -->
		<!-- banner-static-area-start -->
		<div class="banner-static-area bg ptb-50">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="banner-shadow-hover xs-mb">
							<a><img src="{{asset('web/img/banner/8.jpg')}}" alt="banner" /></a>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="banner-shadow-hover">
							<a><img src="{{asset('web/img/banner/9.jpg')}}" alt="banner" /></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- banner-static-area-end -->
		<!-- social-group-area-end -->
		@endsection