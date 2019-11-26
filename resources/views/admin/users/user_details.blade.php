@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>My Profile</h2>
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

                    @if(isset($seller) && !empty($seller))
    	            <div class="x_content">    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter name" value="{{ $seller->name }}" disabled id="name">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="tag_name">Email</label>
                                  <input type="email" class="form-control" placeholder="Enter Email" value="{{ $seller->email }}" disabled >

                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="mobile">Mobile</label>
                                  <input type="text" class="form-control" name="mobile"  placeholder="Enter Mobile Number" value="{{ $seller->mobile }}" id="mobile" disabled>
                                </div>                                                             
                            </div>                        

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="dob">Date Of Birth</label>
                                  <input type="date" class="form-control" name="dob" id="dob" disabled value="{{ $seller->dob }}">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="pan">PAN No</label>
                                  <input type="text" class="form-control" name="pan" value="{{ $seller->pan }}" id="pan" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="size_wearing">Gender</label>
                                  @if($seller->gender =="F")
                                  <p>
                                    Male: <input type="radio" class="flat" name="gender" class="genderM" value="M"  required  /> 
                                    FeMale: <input type="radio" class="flat" name="gender" class="genderF" value="F" checked />
                                  </p>
                                  @else
                                    <p>
                                    Male: <input type="radio" class="flat" name="gender" class="genderM" value="M" checked required /> 
                                    FeMale: <input type="radio" class="flat" name="gender" class="genderF" value="F"  />
                                  </p>
                                  @endif
                                </div>
                            </div>
                        </div>

                        <div class="well" style="overflow: auto">

                            <div class="form-row mb-3">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="dob">State</label>
                                  <input type="text" class="form-control"  value="{{ $seller->state_name }}" id="pan" disabled>
                                </div>
                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="dob">City</label>
                                  <input type="text" class="form-control"  value="{{ $seller->city_name }}" id="pan" disabled>
                                </div>
                          
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="pin">PIN Code </label>
                                  <input type="text" class="form-control" name="pin" value="{{ $seller->pin }}" disabled >
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" name="address" rows="4" disabled id="address">{{ $seller->address }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">    
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="bank_name">Bank Name</label>
                                  <input type="text" class="form-control" name="bank_name" value="{{ $seller->b_name }}" disabled id="bank_name">
                                </div>
                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="branch_name">Branch Name</label>
                                  <input type="text" class="form-control" name="branch_name" value="{{ $seller->branch_name }}" id="branch_name" disabled>
                                </div>
                          
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="account_no">Account Number</label>
                                  <input type="number" class="form-control" name="account_no" value="{{ $seller->account }}" id="account_no" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-10"> 
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="ifsc">IFSC COde</label>
                                  <input type="text" class="form-control" name="ifsc" value="{{ $seller->ifsc }}" disabled id="ifsc">
                                </div>
                            </div>
                       </div>    
                       
                       <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">    
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="bank_name">UPI Name</label>
                                  <input type="text" class="form-control" value="{{ $seller->upi_name }}" disabled >
                                </div>
                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="branch_name">UPI Id</label>
                                  <input type="text" class="form-control" value="{{ $seller->upi_id }}"  disabled>
                                </div>
                          
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="account_no">UPI Mobile</label>
                                  <input type="number" class="form-control" value="{{ $seller->upi_mobile }}"  disabled>
                                </div>
                            </div>
                       </div>  

                       <div class="well" style="overflow: auto">
                            <div class="col-md-12 col-sm-12 col-xs-12 mb-3 clear-fix-cat">
                                <label for="name" style="font-size:20px;">Dealing Category</label>
                            </div>
                            <div class="form-row mb-10">    
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    @if ($dealing_category->book == '2')
                                        <input type="checkbox" name="deal_cat[]" id="1" value="1" class="flat" checked disabled/> Books
                                    @endif
                                    
                                </div> 
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    @if ($dealing_category->project == '2')
                                        <input type="checkbox" name="deal_cat[]" id="2" value="2" class="flat" checked disabled/> Projects
                                    @endif
                                    
                                </div> 
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    @if ($dealing_category->megazine == '2')
                                        <input type="checkbox" name="deal_cat[]" id="3" value="3" class="flat" checked disabled/> Megazines
                                    @endif
                                    
                                </div> 
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    @if ($dealing_category->quiz == '2')
                                        <input type="checkbox" name="deal_cat[]" id="4" value="4" class="flat" checked disabled/> Quiz
                                    @endif
                                    
                                </div> 
                            </div>
                       </div> 
                       
                       <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    @if ($seller->status == '1')
                                        <b>Status :</b> <a class="btn btn-primary">Enabled</a>
                                    @else
                                        <b>Status : </b><a class="btn btn-danger">Disabled</a>
                                    @endif
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    @if ($seller->membership_status == '2')
                                        <b>Memmbership Status :</b> <a class="btn btn-primary">Yes</a>
                                    @else
                                        <b>Memmbership Status : </b><a class="btn btn-warning">No</a>
                                    @endif
                                </div>
                                
                            </div>
                       </div>

    	            </div>
                    @endif
                    <div class="row">
                        @if ($seller->seller_approved_status == '1')
                    <a href="{{route('admin.sellerUpdateVerification',['seller_id'=>encrypt($seller->id)])}}" class="btn btn-warning">Mark As Verified</a>
                        @else
                            <a class="btn btn-success">Verified</a>
                        @endif
                        <button class="btn btn-danger" onclick="javascript:window.close()">Window Close</button>
                    </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

  @section('script')
     <script type="text/javascript">
        var color_html = null;
         var size={};
        $(document).ready(function(){
            $("#state").change(function(){
                var state = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('City/list')}}"+"/"+state+"",
                    success:function(data){
                        // console.log(data);
                        // var cat = JSON.parse(data);
                        $("#city").html("<option value=''>Please Select City</option>");

                        $.each( data, function( key, value ) {
                            $("#city").append("<option value='"+key+"'>"+value+"</option>");
                        });

                    }
                });
            });
        });

    </script>
    {{-- <script src="{{ asset('seller_js/sellerValidation.js') }}"></script> --}}
 @endsection


        
    