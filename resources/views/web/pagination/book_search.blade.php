@if (isset($books) && count($books) > 0 )
    @foreach ($books as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 book-mobile">
            <!-- single-product-start -->
            <div class="product-wrapper new-books mb-40">
                <div class="product-img">
                    <a href="{{route('web.books-detail',['book_id'=>encrypt($item->id)])}}">
                        <img src="{{asset('images/book_image/thumb/'.$item->book_image.'')}}" alt="book" class="primary" />
                    </a>
                </div>
                <div class="product-details text-center">
                    <h4><a class="semi-name" href="{{route('web.books-detail',['book_id'=>encrypt($item->id)])}}">{{$item->book_name}}</a></h4>
                    <h6 class="semi-name">Author: {{$item->author_name}}</h6>
                    <h6 class="semi-name">Publisher: {{$item->publisher_name}}</h6>
                    {{-- <h6 class="semi-name">Book Condition: {{$item->book_condition}}</h6> --}}
                    <div class="product-price">
                        <ul>
                            <li>Rs.{{ number_format($item->price,2,".",'')}}</li>
                            <li class="old-price">₹{{ number_format($item->mrp,2,".",'')}}</li>
                        </ul>
                    </div>
                </div>
                <div class="product-link">
                    <div class="product-button">
                        <a href="{{route('web.books-detail',['book_id'=>encrypt($item->id)])}}" class="btn btn-primary margin-mobile">View</a>
                    </div>                              
                </div>	
            </div>
            <!-- single-product-end -->
        </div>
    @endforeach
@endif
<div class="col-lg-12 col-md-12 col-sm-12 book-mobile">
    {!! $books->onEachSide(2)->links() !!}
</div>

