@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Project Details</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              <div class="row invoice-info">
                @if (isset($project)) 
                <div class="col-sm-6 invoice-col">
                  <table class="table table-striped">
                    <caption>Project Deails</caption>
                    <tr>
                      <th style="width:150px;">Specialization : </th>
                      <td>{{$project->specialization_name}}</td>
                    </tr>

                    
                      <tr>
                        <th>Name : </th>
                        <td>{{$project->name}}</td>
                      </tr>
                  

                    
                      <tr>
                        <th>Cost : </th>
                        <td>{{$project->cost}}</td>
                      </tr>
                   
                    <tr>
                      <th>Pages : </th>
                      <td>{{$project->pages}}</td>
                    </tr>
                    <tr>
                      <th>Description : </th>
                      <td> {{$project->description}} </td>
                    </tr>
                  </table>
                </div>
                @endif
                <div class="col-sm-6 invoice-col">
                   <table class="table table-striped">
                    @if ($project->user_id == 'A')
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
                      <caption>Documents List</caption> 
                        @if(!empty($project->preview))                    
                        <tr>
                          <td>
                             Preview 
                          </td>
                          <td>
                              <a href="{{ route('seller.preview_file_view', ['project_id' => encrypt($project->id)]) }}" target="_blank">View Preview</a>
                          </td>
                        </tr> 
                        @endif  
                        @if(!empty($project->documentation)) 
                        <tr>
                          <td>
                             Documentation 
                          </td>
                          <td>
                              <a href="{{ route('seller.documentation_file_view', ['project_id' => encrypt($project->id)]) }}" target="_blank">View Documentation</a>
                          </td>
                        </tr>
                        @endif    
                        @if(!empty($project->synopsis)) 
                        <tr>
                          <td>
                             Synopsis 
                          </td>
                          <td>
                              <a href="{{ route('seller.synopsis_file_view', ['project_id' => encrypt($project->id)]) }}" target="_blank">View Synopsis</a>
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