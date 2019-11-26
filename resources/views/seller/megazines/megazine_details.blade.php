@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Megazine Details</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              <div class="row invoice-info">
                @if (isset($megazine)) 
                <div class="col-sm-6 invoice-col">
                  <table class="table table-striped">
                    <caption>Megazine Deails</caption>
                    <tr>
                      <th style="width:150px;">Category : </th>
                      <td>{{$megazine->category_name}}</td>
                    </tr>

                    
                      <tr>
                        <th>Name : </th>
                        <td>{{$megazine->name}}</td>
                      </tr>
                  

                    
                      <tr>
                        <th>Cost : </th>
                        <td>{{$megazine->cost}}</td>
                      </tr>
                   
                    <tr>
                      <th>Pages : </th>
                      <td>{{$megazine->pages}}</td>
                    </tr>
                    <tr>
                      <th>Description : </th>
                      <td> {{$megazine->description}} </td>
                    </tr>
                  </table>
                </div>
                @endif
                <div class="col-sm-6 invoice-col">
                   <table class="table table-striped">
                    @if ($megazine->user_id == 'A')
                      <caption>Seller Deails</caption>
                      <tr>
                        <th>Seller Name : </th>
                        <td>Admin</td>
                      </tr>
                      <tr>
                        <th>Mobile No : </th>
                        <td></td>
                      </tr>
                      <tr>
                        <th>Email : </th>
                        <td></td>
                      </tr>
                      <tr>
                        <th>Address : </th>
                        <td></td>
                      </tr>
                    @else
                      <caption>Seller Deails</caption>
                      <tr>
                        <th>Seller Name : </th>
                      <td>{{$seller->name}}</td>
                      </tr>
                      <tr>
                        <th>Mobile No : </th>
                        <td>{{$seller->mobile}}</td>
                      </tr>
                      <tr>
                        <th>Email : </th>
                        <td>{{$seller->email}}</td>
                      </tr>
                      <tr>
                        <th>Address : </th>
                        <td>{{$seller->address}}</td>
                      </tr>
                    @endif
                  </table>

                  
                    <table class="table table-striped">
                      <caption>Documents & Cover Image List</caption> 
                        @if(!empty($megazine->cover_image))                    
                        <tr>
                          <td>
                             Cover Image 
                          </td>
                          <td>
                              <a href="{{ route('seller.cover_image_view', ['megazine_id' => encrypt($megazine->id )]) }}" target="_blank">View Cover Image</a>
                          </td>
                        </tr> 
                        @endif  
                        @if(!empty($megazine->file_name)) 
                        <tr>
                          <td>
                             File 
                          </td>
                          <td>
                              <a href="{{ route('seller.megazine_file_view', ['megazine_id' => encrypt($megazine->id ) ]) }}" target="_blank">View File</a>
                          </td>
                        </tr>
                        @endif               
                    </table>
                 

                </div>
              </div>
              <!-- /.row -->
              <hr>
           


              <div class="row">
                <button class="btn btn-primary" onclick="javascript:window.close()">Window Close</button>
              </div>
              <!-- /.row -->
            </section>
          </div>
        </div>
      </div>
    </div>

</div>


 @endsection

@section('script')
     

    
 @endsection