@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Add Project</h2>
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
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'admin.insert_new_project' , 'enctype'=>'multipart/form-data']) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="category">Specialization</label>
                                    <select class="form-control" name="specialization">
                                        <option selected disabled>Select Specialization</option>
                                        @if(isset($project_spalization))
                                            @foreach($project_spalization as $ps)
                                                <option value="{{$ps->id}}" {{ old('specialization') == $ps->id ? 'selected' : '' }}>{{ $ps->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('specialization'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('specialization') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="book_name">Name</label>
                                  <input type="text" class="form-control" name="project_name"  placeholder="Enter Project Name" value="{{ old('project_name') }}">
                                  @if($errors->has('project_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('project_name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="author_name">Cost</label>
                                  <input type="text" class="form-control" value="{{ old('cost') }}" name="cost"  placeholder="Enter Cost">
                                    @if($errors->has('cost'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('cost') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="pages">Pages</label>
                                    <input type="number" min="1" class="form-control" value="{{ old('pages') }}" name="pages"  placeholder="Enter Pages">
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
                                    <label for="language">Upload Documentation</label>
                                    <input type="file" name="documentation" class="form-control">
                                    @if($errors->has('documentation'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('documentation') }}</strong>
                                        </span>
                                    @enderror
                                </div>                        
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="language">Upload Synopsis</label>
                                    <input type="file" name="synopsis" class="form-control">
                                    @if($errors->has('synopsis'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('synopsis') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="language">Upload Preview</label>
                                    <input type="file" name="preview" class="form-control" required>
                                    @if($errors->has('preview'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('preview') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="size">Upload PPT</label>
                                    <input type="file" name="ppt" class="form-control">
                                    @if($errors->has('ppt'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('ppt') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="description">Type Project Descrpition</label>
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


        
    