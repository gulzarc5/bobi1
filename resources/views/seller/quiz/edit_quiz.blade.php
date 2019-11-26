@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Edit Quiz Form</h2>
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
    	           
                        {{ Form::open(['method' => 'post','route'=>'seller.update_quiz' , 'enctype'=>'multipart/form-data']) }}
                        @if (isset($quiz) && !empty($quiz))
                    <input type="hidden" name="quiz_id" value="{{ encrypt($quiz->id) }}">
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Quiz Name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter Quiz Name"  value="{{ $quiz->name }}">
                                  @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>                                                            
                            </div>

                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="pages">No. of Pages</label>
                                  <input type="text" class="form-control" name="pages"  placeholder="Enter No of Pages"  value="{{ $quiz->pages }}">
                                  @if($errors->has('pages'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pages') }}</strong>
                                        </span>
                                    @enderror
                                </div>                                                            
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="category" >
                                        <option value="">Select Category</option>
                                        @if(isset($category))
                                            @foreach($category as $cat)
                                                @if ($quiz->category_id == $cat->id)
                                                    <option value="{{$cat->id}}" {{ old('category') == $cat->id ? 'selected' : '' }} selected>{{$cat->name}}</option>
                                                @else
                                                    <option value="{{$cat->id}}" {{ old('category') == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
                                                @endif                                               
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('category'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @enderror
                                </div>                       
                            </div>
                        </div>

                        {{-- <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="size">Quiz File</label>
                                <input type="file" name="file" class="form-control">
                                    @if($errors->has('file'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="description">Type Quiz Descrpition</label>
                                    <textarea id="editor1" class="form-control" rows="6" name="description">{{ $quiz->description }}</textarea>
                                </div>
                            </div>
                       </div>

    	            	<div class="form-group">    	            	
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}  
                                <a href="{{route('seller.quiz_list')}}" class="btn btn-warning">Back</a>
                        </div>
                        @endif
    	            	{{ Form::close() }}

    	            </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

 @section('script')
 <script src="{{ asset('admin/ckeditor5/ckeditor.js')}}"></script>
 <script>
     ClassicEditor
         .create( document.querySelector( '#editor1' ))

         .catch( error => {
             console.error( error );
         });
 </script>
@endsection

        
    