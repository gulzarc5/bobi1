@if (isset($quiz) && !empty($quiz))
    @foreach ($quiz as $quizs)
        <div class="product-wrapper mb-40 " style="">
            <h4 style="margin: 0;"><a href="{{route('web.quiz_detail',['quiz_id'=>encrypt($quizs->id)])}}">{{$quizs->name}}</a></h4>
            <div class="col-md-12">
                <div class="product-details flex-center quiz-content" style="justify-content: space-around;width: 100%">                                                
                    <h4><a href="{{route('web.quiz_detail',['quiz_id'=>encrypt($quizs->id)])}}">Catagory : {{$quizs->cat_name}}</a></h4>
                    <h4><a href="{{route('web.quiz_detail',['quiz_id'=>encrypt($quizs->id)])}}">Total pages : {{$quizs->pages}}</a></h4>
                </div>
            </div>
            {{-- <div class="col-md-12">
                <div class="product-details">                                                
                    <h4><a href="{{route('web.quiz_detail',['quiz_id'=>encrypt($quizs->id)])}}">Description :</a></h4>
                    <p class="line-clamp2">{{$quizs->description}}</p>
                </div>
            </div> --}}
            <div class="col-md-12">
                <div class="product-button" style="display:flex;justify-content:center" >
                    <a href="{{route('web.quiz_detail',['quiz_id'=>encrypt($quizs->id)])}}" title="Add to cart" class="btn btn-primary margin-mobile">View Quiz</a>
                    {{-- <a href="{{route('web.quiz_detail',['quiz_id'=>encrypt($quizs->id)])}}" title="Add to cart" class="btn btn-primary margin-mobile">View Detail</a> --}}
                </div>                                            	
            </div>	
        <div class="clearfix"></div>
        </div>
    @endforeach
@endif

<div class="col-lg-12 col-md-12 col-sm-12 book-mobile">
    {!! $quiz->onEachSide(2)->links() !!}
</div>