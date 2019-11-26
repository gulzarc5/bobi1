@extends('admin.template.admin_master')

@section('content')

  <div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
        <div class="count green">{{$buyer_count}}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Total Sellers</span>
        <div class="count green">{{$seller_count}}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i> Total Books</span>
          <div class="count green">{{$books_count}}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Projects</span>
        <div class="count green">{{$projectss_count}}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Megazine</span>
        <div class="count green">{{$megazine_count}}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Quiz</span>
        <div class="count green">{{$quiz_count}}</div>
      </div>
      
    </div>
    <!-- /top tiles -->

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
                 {{--//////////// Last Ten Sellers //////////////--}}
                 <div class="table-responsive">
                    <h2>Last 10 Registered Sellers</h2>
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">                
                                <th class="column-title">Sl No. </th>
                                <th class="column-title">Name</th>
                                <th class="column-title">Email</th>
                                <th class="column-title">Mobile No</th>
                                <th class="column-title">Varification Status</th>
                                <th class="column-title">Date</th>
                            </tr>
                        </thead>

                        <tbody>
                          @if (isset($last_seller) && !empty($last_seller) ).
                          @php
                              $count_seller = 1;
                          @endphp
                              @foreach ($last_seller as $item)
                                <tr>
                                  <td>{{$count_seller++}}</td>
                                  <td>{{$item->name}}</td>
                                  <td>{{$item->email}}</td>
                                  <td>{{$item->mobile}}</td>
                                  <td>
                                    @if ($item->seller_approved_status == '2')
                                      <a class="btn btn-success">Approved</a>
                                    @else
                                      <a class="btn btn-danger">Not Approved</a>
                                    @endif
                                  </td>
                                  <td>{{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString()}}</td>
                                </tr>
                              @endforeach
                          @endif
                        </tbody>
                    </table>
                </div>

                  {{--//////////// Last Ten Orders //////////////--}}
                  {{-- <div class="table-responsive">
                      <h2>Last 10 Orders</h2>
                      <table class="table table-striped jambo_table bulk_action">
                          <thead>
                              <tr class="headings">                
                                  <th class="column-title">Sl No. </th>
                                  <th class="column-title">Order id</th>
                                  <th class="column-title">Order By</th>
                                  <th class="column-title">Total Quantity</th>
                                  <th class="column-title">Total Amount</th>
                                  <th class="column-title">Payment Method</th>
                                  <th class="column-title">Date</th>
                              </tr>
                          </thead>

                          <tbody>
                          </tbody>
                      </table>
                  </div> --}}

                 

              </div>
          </div>
      </div>

    </div>

  </div>

 @endsection