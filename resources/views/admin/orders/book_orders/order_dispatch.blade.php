
@extends('admin.template.admin_master')
@section('content')
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                <h2>Dispatch Order of Order Id {{$order_id}}</h2>
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
                        {{ Form::open(['method' => 'post','route'=>'admin.book_order_dispatch']) }}                       
                    <input type="hidden" name="order_id" value="{{$order_id}}">
                        <div class="form-group">
                            {{ Form::label('courier_name', 'Courier Name')}}
                            <input type="text" name="courier_name" value="{{old('courier_name')}}" class="form-control">
                            @if($errors->has('courier_name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('courier_name') }}</strong>
                                </span>                            
                            @enderror
                            <br>
                            {{ Form::label('consignment', 'Consignment Number')}}
                            <input type="text" name="consignment" value="{{old('consignment')}}" class="form-control">

                            @if($errors->has('consignment'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('consignment') }}</strong>
                                </span>                            
                            @enderror

                        </div>

                        <div class="form-group">
                            {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}  
                        </div>
                        {{ Form::close() }}

                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="clearfix"></div>
</div>


 @endsection
