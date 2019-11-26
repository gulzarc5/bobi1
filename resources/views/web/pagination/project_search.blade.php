@if (isset($project) && count($project) > 0 )
    @foreach ($project as $item)
        <div class="product-wrapper mb-40 " style="">
            <h4><a href="{{route('web.project_detail', ['project_id' => encrypt($item->id)])}}">
                {{ $item->name }}</a></h4>
            <div class="col-md-6">
            <div class="product-details">                                                
                <h4><a href="{{route('web.project_detail', ['project_id' => encrypt($item->id)])}}">Total pages: {{ $item->pages }}</a></h4>
                <h4><a href="{{route('web.project_detail', ['project_id' => encrypt($item->id)])}}">Cost: Rs. {{ number_format($item->cost,2,".",'')}}</a></h4>
                </div>
                <div class="">
                    <div class="product-button">
                        <a href="{{route('web.project_detail', ['project_id' => encrypt($item->id)])}}" title="View Project" class="btn btn-primary margin-mobile">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <h4><a href="{{route('web.project_detail', ['project_id' => encrypt($item->id)])}}">Specialisation: <span>{{$item->ps_name}}</span></a></h4>
                    <h4><a href="{{route('web.project_detail', ['project_id' => encrypt($item->id)])}}">Package Includes:</a></h4>
                    <p>Preview/<span>Documentation</span>/<span>PPT</span>/</p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    @endforeach
@endif
<div class="col-lg-12 col-md-12 col-sm-12 book-mobile">
    {!! $project->onEachSide(2)->links() !!}
</div>

