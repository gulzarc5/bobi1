@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Edit Megezine</h2>
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
    	           
    	            	 @if (isset($megazine) && !empty($megazine))
                        {{ Form::open(['method' => 'post','route'=>'seller.megazine_update' , 'enctype'=>'multipart/form-data']) }}
                        <input type="hidden" name="megazine_id" value="{{ encrypt($megazine->id) }}" required>
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="megazine_category">
                                        <option selected disabled>Select Category</option>
                                        @if(isset($magazine_category))
                                            @foreach($magazine_category as $mc)
                                                @if ($mc->id == $megazine->category_id)
                                                    <option value="{{$mc->id}}" selected>{{$mc->name}}</option>
                                                @else
                                                    <option value="{{$mc->id}}" {{ old('megazine_category') == $mc->id ? 'selected' : '' }}>{{$mc->name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('megazine_category'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('megazine_category') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="book_name">Name</label>
                                  <input type="text" class="form-control" name="megazine_name" placeholder="Enter Megazine Name" value="{{ $megazine->name }}">
                                  @if($errors->has('megazine_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('megazine_name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="author_name">Cost</label>
                                  <input type="text" class="form-control"  value="{{ $megazine->cost }}" name="cost"  placeholder="Enter Cost">
                                    @if($errors->has('cost'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('cost') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="pages">Pages</label>
                                    <input type="number" min="1" class="form-control"  value="{{ $megazine->pages }}" name="pages"  placeholder="Enter Pages">
                                    @if($errors->has('pages'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pages') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                                            
                            </div>
                        </div>

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3" >
                                    <label for="language">Upload File</label>
                                    <input type="file" name="megazine_file" class="form-control">
                                    @if($errors->has('megazine_file'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('megazine_file') }}</strong>
                                        </span>
                                    @enderror
                                </div>                        
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="language">Upload Cover Image</label>
                                    <input type="file" name="cover_image" class="form-control">
                                    @if($errors->has('cover_image'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('cover_image') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="description">Type Megazine Descrpition</label>
                                    <textarea class="form-control" rows="6" name="description">{{ $megazine->description  }}</textarea>
                                </div>
                            </div>
                       </div>

    	            	<div class="form-group">    	            	
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}  
    	            	</div>
    	            	{{ Form::close() }}
                        @endif
    	            </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

@section('script')

 @endsection


        
    