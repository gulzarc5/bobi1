@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Add New Book</h2>
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
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'admin.insert_new_book' , 'enctype'=>'multipart/form-data']) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                {{-- <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="book_id_prefix">Book ID Prefix</label>
                                  <input type="text" class="form-control" name="book_id_prefix" value="{{ old('book_id_prefix') }}"  placeholder="Enter Book Id Prefix Only Text" >
                                    @if($errors->has('book_id_prefix'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('book_id_prefix') }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="book_name">Book Name</label>
                                  <input type="text" class="form-control" name="book_name"  placeholder="Enter Book Name"  value="{{ old('book_name') }}">
                                  @if($errors->has('book_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('book_name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="author_name">Author Name</label>
                                  <input type="text" class="form-control" name="author_name"  placeholder="Enter Book Author Name" value="{{ old('author_name') }}" >
                                    @if($errors->has('author_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('author_name') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" class="form-control" name="isbn"  placeholder="Enter Book Author Name" value="{{ old('author_name') }}" >
                                    @if($errors->has('isbn'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('isbn') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                                            
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="publisher_name">Publisher Name</label>
                                  <input type="text" class="form-control" name="publisher_name"  placeholder="Enter Publisher Name" value="{{ old('publisher_name') }}">
                                    @if($errors->has('publisher_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('publisher_name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="published_year">Publishd Year</label>
                                  <input type="date" class="form-control" name="published_year" value="{{ old('published_year') }}">
                                    @if($errors->has('published_year'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('published_year') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="book_condition">Book Condition</label>
                                    <select class="form-control" name="book_condition" >
                                        <option value="">Select Book Condition</option>
                                        <option value="1" {{ old('book_condition') == 1 ? 'selected' : '' }}>New</option>
                                        <option value="2" {{ old('book_condition') == 2 ? 'selected' : '' }}>Old</option>
                                    </select>
                                    @if($errors->has('book_condition'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('book_condition') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="book_type">Book Type</label>
                                    <select class="form-control" name="book_type" >
                                        <option value="">Select Book Type</option>
                                        <option value="1" {{ old('book_type') == 1 ? 'selected' : '' }}>Academic</option>
                                        <option value="2" {{ old('book_type') == 2 ? 'selected' : '' }}>Non Aceademic</option>
                                    </select>
                                    @if($errors->has('book_type'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('book_type') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="category" >
                                        <option value="">Select Category</option>
                                        @if(isset($category))
                                            @foreach($category as $cat)
                                                <option value="{{$cat->id}}" {{ old('category') == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('category'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="sub_category">Sub Category</label>
                                    <select class="form-control" name="sub_category" >
                                        <option value="">Sub Category</option>
                                        @if(isset($sub_category))
                                            @foreach($sub_category as $cat)
                                                <option value="{{$cat->id}}" {{ old('sub_category') == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('sub_category'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('sub_category') }}</strong>
                                        </span>
                                    @enderror
                                </div>                        
                            </div>
                        </div>

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3" >
                                    <label for="language">Select Language</label>
                                    <select class="form-control" name="language">
                                        <option value="">Please Select Language</option>
                                        @if(isset($language))
                                            @foreach($language as $lang)
                                                <option value="{{$lang->id}}" {{ old('language') == $lang->id ? 'selected' : '' }}>{{$lang->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('language'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('language') }}</strong>
                                        </span>
                                    @enderror
                                </div>                        
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="stock">Stock</label>
                                  <input type="text" class="form-control" name="stock"  placeholder="Enter Stock" value="{{ old('stock') }}">
                                    @if($errors->has('stock'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="mrp">M.R.P</label>
                                  <input type="number" class="form-control" name="mrp"  placeholder="Enter M.R.P." value="{{ old('mrp') }}">
                                    @if($errors->has('mrp'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mrp') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="price">Selling Price</label>
                                  <input type="text" class="form-control" name="price"  placeholder="Enter Selling Price" value="{{ old('price') }}">
                                    @if($errors->has('price'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="shipping_charge">Shipping Charge</label>
                                  <input type="text" class="form-control" name="shipping_charge"  placeholder="Enter Shipping Charge" value="{{ old('shipping_charge') }}">
                                    @if($errors->has('shipping_charge'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('shipping_charge') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="size">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if($errors->has('image'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="description">Type Book Descrpition</label>
                                    <textarea class="form-control" rows="6" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                       </div>

    	            	<div class="form-group">    	            	
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}  
    	            	</div>
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

 @endsection


        
    