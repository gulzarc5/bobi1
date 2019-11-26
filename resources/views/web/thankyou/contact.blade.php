		@extends('web.template.master')
		<!-- Head & Header Section -->
		@section('content') 
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-10">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#" class="active">Contact Us</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- user-login-area-start -->
		<div class="user-login-area mb-70">
			<div class="container">
				<div class="section-title-5 mb-30" style="text-align: center;">
					<h2>Contact Us</h2>
					@if (Session::has('message'))
                        <div class="alert alert-success" >{{ Session::get('message') }}</div>
                     @endif
				</div>
				<div class="row">
					<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
						<div class="login-form contact-form">
							<h3><i class="fa fa-envelope-o"></i>Leave a Message</h3>
                           {{ Form::open(['method' => 'post','route'=>'web.contact']) }}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-form-3">
										<input name="name" type="text" value="{{old('name')}}" placeholder="Name">
										@if($errors->has('name'))
											<span class="invalid-feedback" role="alert" style="color:red">
												<strong>{{ $errors->first('name') }}</strong>
											</span>
										@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-form-3">
											<input name="email" type="email" placeholder="Email" value="{{old('email')}}">
											@if($errors->has('email'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('email') }}</strong>
												</span>
											@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-form-3">
											<input name="subject" type="text" placeholder="Subject" value="{{old('subject')}}">
											@if($errors->has('subject'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('subject') }}</strong>
												</span>
											@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                         <div class="single-form-3">
											<textarea name="message" placeholder="Message">{{old('message')}}</textarea>
											@if($errors->has('message'))
												<span class="invalid-feedback" role="alert" style="color:red">
													<strong>{{ $errors->first('message') }}</strong>
												</span><br>
											@enderror
                                            <button class="submit" type="submit">SEND MESSAGE</button>
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- user-login-area-end -->
		@endsection