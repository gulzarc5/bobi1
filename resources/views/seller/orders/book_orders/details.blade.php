@extends('seller.template.seller_master')

@section('content')
<style>
  .order-sub-head{
    font-size: 19px;
    font-variant: small-caps;
    font-weight: bold;
  }
  .link{
    color: #09e29c;
    font-weight: bold;
    text-decoration: underline;
  }
</style>
<div class="right_col" role="main">

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Order Details of Order 1</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              <div class="row invoice-info">
                @if ($order_details && !empty($order_details))
                  <div class="col-sm-6 invoice-col">
                    <table class="table table-striped">
                      <caption class="order-sub-head">Order Deails</caption>
                      <tr>
                        <th style="width:150px;">Order Id : </th>
                        <td>{{$order_details->order_id}}</td>
                      </tr>
                      <tr>
                      <tr>
                        <th style="width:150px;">Customer Order Id : </th>
                        <td>{{$order_details->id}}</td>
                      </tr>
                      <tr>
                        <th>Order By : </th>
                        <td><a href="#" target="_blank" class="link">{{$order_details->u_name}}</a></td>
                      </tr>
                      <tr>
                        <th>Quantity : </th>
                        <td>{{$order_details->quantity}}</td>
                      </tr>                   
                      <tr>
                        <th>Shipping Charge : </th>
                        <td>{{ number_format($order_details->shipping_charge,2,".",'') }}</td>
                      </tr>
                      <tr>
                        <th>Amount : </th>
                        <td>{{ number_format(($order_details->rate*$order_details->quantity),2,".",'') }} </td>
                      </tr>
                      <tr>
                      <th>Payment Method : </th>
                        <td>
                          @if ($order->payment_method == 1)
                              <a class="btn btn-info">COD</a>
                          @else
                            <a class="btn btn-success">Online</a>
                          @endif
                        </td>
                      </tr>
                      @if ($order->payment_method == 2 && $order->payment_status == '2')
                        <tr>
                          <th>Payment Request Id : </th>
                          <td> {{$order->payment_request_id}} </td>
                        </tr>
                        <tr>
                          <th>Payment Id : </th>
                          <td>{{$order->payment_id}}</td>
                        </tr>
                      @endif
                      
                      <tr>
                        <th>Order Status : </th>
                        <td>
                          @if ($order_details->status == '1')
                            <a class="btn btn-warning"> Pending </a>
                          @elseif ($order_details->status == '2')
                            <a class="btn btn-info"> Dispatched </a>
                          @elseif ($order_details->status == '3')
                            <a class="btn btn-success"> Delivered </a>
                          @else
                            <a class="btn btn-danger"> Cancel </a>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th>Payment Status : </th>
                        <td>
                          @if ($order->payment_status == '1')
                            <a class="btn btn-primary"> Paid </a>
                          @else
                            <a class="btn btn-warning"> Not Paid </a>
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th>Order On : </th>
                        <td>{{ \Carbon\Carbon::parse($order_details->created_at)->toDayDateTimeString()}}</td>
                      </tr>   
                    </table>
                  </div>
                @endif

                @if (isset($shipping_address) && !empty($shipping_address))
                  <div class="col-sm-6 invoice-col">
                    <table class="table table-striped">
                     <caption class="order-sub-head">Shipping Address</caption>
                     <tr>
                       <th>Name : </th>
                     <td>{{$shipping_address->name}}</td>
                     </tr>
                     <tr>
                       <th>Mobile No : </th>
                       <td>{{$shipping_address->mobile}}</td>
                     </tr>
                     <tr>
                       <th>Email : </th>
                       <td>{{$shipping_address->email}}</td>
                     </tr>
                     <tr>
                       <th>Address : </th>
                       <td>{{$shipping_address->address}},{{$shipping_address->c_name}},{{$shipping_address->s_name}}-{{$shipping_address->pin}},</td>
                     </tr>
                   </table>
                  </div>
                @endif
                
              </div>
              <!-- /.row -->
              <hr>
            </section>
          </div>
        </div>
      </div>
    </div>


    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Product Details</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Book Id</th>
                                    <th class="column-title">Book Name</th>
                                    <th class="column-title">Book Language</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Book Quantity</th>
                                    <th class="column-title">Price</th>
                                    <th class="column-title">Shipping Charge</th>
                                    <th class="column-title">Total</th>                                    
                                    <th class="column-title">Action</th>
                                </tr>
                            </thead>
                                @if (isset($order_details) && !empty($order_details))
                                      @php
                                          $total = ($order_details->rate * $order_details->quantity); 
                                      @endphp
                                        <tr>
                                          <td>{{$order_details->id}}</td>
                                          <td>{{$order_details->book_name}}</td>
                                          <td>{{$order_details->language}}</td>
                                          <td>
                                              @if ($order_details->status == 1)
                                                <a class="btn btn-warning">Pending</a>
                                              @elseif($order_details->status == 2)
                                                <a class="btn btn-info">Dispatched</a>
                                              @elseif($order_details->status == 3)  
                                                <a class="btn btn-success">Delivered</a>   
                                              @else       
                                                <a class="btn btn-danger">Cancel</a>
                                              @endif
                                            </td>
                                          <td>{{$order_details->quantity}}</td>
                                          <td>{{ number_format($order_details->rate,2,".",'') }}</td>
                                          <td>{{ number_format($order_details->shipping_charge,2,".",'') }}</td>
                                          <td>{{ number_format(($order_details->rate*$order_details->quantity),2,".",'') }}</td>
                                          <td>
                                            @if($order->payment_method == '2' && $order->payment_status == '2')
                                              <a class="btn btn-danger">Payment Failed</a>
                                            @elseif ($order_details->status == 1)
                                              <a href="{{route('seller.book_order_dispatch_form',['order_id'=>encrypt($order_details->id)])}}" class="btn btn-info">Dispatch</a>
                                              <a href="{{route('seller.book_order_status',['order_id'=>encrypt($order_details->id),'status'=>encrypt(4)])}}" class="btn btn-danger">Cancel</a>
                                            @elseif($order_details->status == 2)
                                              <a href="{{route('seller.book_order_status',['order_id'=>encrypt($order_details->id),'status'=>encrypt(3)])}}" class="btn btn-success">Delivered</a>
                                              <a href="{{route('seller.book_order_status',['order_id'=>encrypt($order_details->id),'status'=>encrypt(4)])}}" class="btn btn-danger">Cancel</a>
                                            @endif
                                          </td>
                                        </tr>
                                @endif
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <button class="btn btn-primary" onclick="javascript:window.close()">Window Close</button>
      </div>
</div>


 @endsection

@section('script')
     

    
 @endsection