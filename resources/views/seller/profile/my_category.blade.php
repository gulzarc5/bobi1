@extends('seller.template.seller_master')

@section('content')
<style>

</style>

<div class="right_col" role="main">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        @if (isset($dealing_category) && !empty($dealing_category))
            <div class="clearfix"></div>
            <div class="col-md-12 col-xs-12" style="margin-top:50px;">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>My Dealing Category</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div>
                        @if (Session::has('message'))
                            <div class="alert alert-success" >{{ Session::get('message') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif

                    </div>
                    <div>
                        <div class="x_content">                    
                            {{ Form::open(['method' => 'post','route'=>'seller.MyCategoryUpdate']) }}                            
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3 clear-fix-cat">
                                        <label for="name" style="font-size:20px;">Dealing Category</label>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        @if ($dealing_category->book == '2')
                                            <input type="checkbox" name="deal_cat[]" id="1" value="1" class="flat" checked/> Books
                                        @else
                                            <input type="checkbox" name="deal_cat[]" id="1" value="1" class="flat" /> Books
                                        @endif
                                        
                                    </div> 
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        @if ($dealing_category->project == '2')
                                            <input type="checkbox" name="deal_cat[]" id="2" value="2" class="flat" checked/> Projects
                                        @else
                                            <input type="checkbox" name="deal_cat[]" id="2" value="2" class="flat" /> Projects
                                        @endif
                                        
                                    </div> 
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        @if ($dealing_category->megazine == '2')
                                            <input type="checkbox" name="deal_cat[]" id="3" value="3" class="flat" checked/> Megazines
                                        @else
                                            <input type="checkbox" name="deal_cat[]" id="3" value="3" class="flat" /> Megazines
                                        @endif
                                        
                                    </div> 
                                    {{-- <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                        @if ($dealing_category->quiz == '2')
                                            <input type="checkbox" name="deal_cat[]" id="4" value="4" class="flat" checked/> Quiz
                                        @else
                                            <input type="checkbox" name="deal_cat[]" id="4" value="4" class="flat" /> Quiz 
                                        @endif
                                        
                                    </div>  --}}
                                </div>
                            </div>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group" id="seller_btn">
                                <button type="submit"  class="btn btn-success" >Save</button>
                            </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

 


        
    