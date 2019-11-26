@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Quiz Details</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              @if (isset($quiz) && !empty($quiz))
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <table class="table table-striped">
                    <caption>Quiz Deails</caption>
                    <tr>
                      <th style="width:150px;">Name : </th>
                      <td>{{$quiz->name}}</td>
                    </tr>
                    <tr>
                      <th>Category : </th>
                      <td>{{$quiz->cat_name}}</td>
                    </tr>
                    <tr>
                      <th>No Of Pages : </th>
                      <td>{{$quiz->pages}}</td>
                    </tr>
                   
                    <tr>
                      <th>Status : </th>
                      <td>
                        @if ($quiz->status == '1')
                            <a class="btn btn-success">Enabled</a>
                        @else
                          <a class="btn btn-warning">Disabled</a>                            
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <th>Approve Status : </th>
                      <td>
                        @if ($quiz->approve_status == '1')
                          <a class="btn btn-success">Yes</a>
                        @else
                          <a class="btn btn-danger">No</a>                            
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <th>Date Added : </th>
                      <td> {{ \Carbon\Carbon::parse($quiz->created_at)->toDayDateTimeString()}} </td>
                    </tr>                   
                  </table>
                </div>
                <div class="col-sm-6 invoice-col">
                  @if (!isset($seller) && empty($seller))
                    <table class="table table-striped">
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
                    </table>
                  @else
                    <table class="table table-striped">
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
                    </table>
                  @endif
                 

                </div>

                <div class="col-sm-12 invoice-col">
                  <center><h1>Quiz</h1></center><hr>
                    {!!$quiz->description!!}
                </div>
              </div>
              @endif
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