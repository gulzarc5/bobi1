@if (isset($megazine) && count($megazine) > 0 )
    @foreach ($megazine as $item)
    <div class="col-lg-3 col-md-4 col-sm-6 book-mobile">
                                        <!-- single-product-start -->
        <div class="product-wrapper new-books mb-40">
            <div class="product-img">
                <a href="{{route('web.megazine_detail', ['megazine_id' => encrypt($item->id)])}}">
                    <img src="{{asset('images/megazines/thumb/'.$item->cover_image.'')}}" alt="Cover Image" class="primary" />
                </a>
            </div>
            <div class="product-details text-center">
                <h4><a class="semi-name" href="{{route('web.megazine_detail', ['megazine_id' => encrypt($item->id)])}}">{{ $item->name }}</a></h4>
                <div class="product-price">
                    <ul>
                        <li>₹ {{ number_format($item->cost,2,".",'')}}</li>
                    </ul>
                </div>
            </div>
            <div class="product-link">
                <div class="product-button">
                    <a href="{{route('web.megazine_detail', ['megazine_id' => encrypt($item->id)])}}" class="btn btn-primary margin-mobile">View</a>
                </div>                              
            </div>  
        </div>
                                        <!-- single-product-end -->
    </div>
    @endforeach
@endif
<div class="col-lg-12 col-md-12 col-sm-12 book-mobile">
    {!! $megazine->onEachSide(2)->links() !!}
</div>

