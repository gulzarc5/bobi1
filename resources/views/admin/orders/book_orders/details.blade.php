@extends('admin.template.admin_master')

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
                @if ($order && !empty($order))
                  <div class="col-sm-6 invoice-col">
                    <table class="table table-striped">
                      <caption class="order-sub-head">Order Deails</caption>
                      <tr>
                        <th style="width:150px;">Order Id : </th>
                        <td>{{$order->id}}</td>
                      </tr>
                      <tr>
                        <th>Order By : </th>
                        <td><a href="#" target="_blank" class="link">{{$order->u_name}}</a></td>
                      </tr>
                      <tr>
                        <th>Total Quantity : </th>
                        <td>{{$order->total_quantity}}</td>
                      </tr>                   
                      <tr>
                        <th>Shipping Charge : </th>
                        <td>{{ number_format($order->shipping_charge,2,".",'') }}</td>
                      </tr>
                      <tr>
                        <th>Amount : </th>
                        <td>{{ number_format($order->total_amount,2,".",'') }} </td>
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
                      @if ($order->payment_method == 2)
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
                          @if ($order->status == '1')
                            <a class="btn btn-warning"> Pending </a>
                          @elseif ($order->status == '2')
                            <a class="btn btn-info"> Dispatched </a>
                          @elseif ($order->status == '3')
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
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->toDayDateTimeString()}}</td>
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
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Book Id</th>
                                    <th class="column-title">Seller Name</th>
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
                                      $total_shipping_amount = 0 ;
                                      $total_amount = 0;
                                      $order_count = 1;
                                  @endphp
                                    @foreach ($order_details as $item)
                                      @php
                                          $total = ($item->rate * $item->quantity); 
                                          $total_shipping_amount += $item->shipping_charge ;
                                          $total_amount += $total;
                                      @endphp
                                        <tr>
                                          <td>{{$order_count++}}</td>
                                          <td>{{$item->id}}</td>
                                          <td>{{$item->seller_name}}</td>
                                          <td>{{$item->book_name}}</td>
                                          <td>{{$item->language}}</td>
                                          <td>
                                              @if ($item->status == 1)
                                                <a class="btn btn-warning">Pending</a>
                                              @elseif($item->status == 2)
                                                <a class="btn btn-info">Dispatched</a>
                                              @elseif($item->status == 3)  
                                                <a class="btn btn-success">Delivered</a>   
                                              @else       
                                                <a class="btn btn-danger">Cancel</a>
                                              @endif
                                            </td>
                                          <td>{{$item->quantity}}</td>
                                          <td>{{ number_format($item->rate,2,".",'') }}</td>
                                          <td>{{ number_format($item->shipping_charge,2,".",'') }}</td>
                                          <td>{{ number_format($total,2,".",'') }}</td>
                                          <td>
                                            @if ($item->status == 1)
                                              <a href="{{route('admin.book_order_dispatch_form',['order_id'=>encrypt($item->id)])}}" class="btn btn-info">Dispatch</a>
                                              <a href="{{route('admin.book_order_status',['order_id'=>encrypt($item->id),'status'=>encrypt(4)])}}" class="btn btn-danger">Cancel</a>
                                            @elseif($item->status == 2)
                                              <a href="{{route('admin.book_order_status',['order_id'=>encrypt($item->id),'status'=>encrypt(3)])}}" class="btn btn-success">Delivered</a>
                                              <a href="{{route('admin.book_order_status',['order_id'=>encrypt($item->id),'status'=>encrypt(4)])}}" class="btn btn-danger">Cancel</a>
                                            @endif
                                          </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                  <td colspan="9" align="right">Total</td>
                                  <td colspan="2" align="left">{{ number_format($total_amount,2,".",'') }}</td>
                                </tr>
                                <tr>
                                  <td colspan="9" align="right">Shipping Charge</td>
                                  <td colspan="2" align="left">{{ number_format($total_shipping_amount,2,".",'') }}</td>
                                </tr>
                                <tr>
                                  <td colspan="9" align="right">Grand Total</td>
                                  <td colspan="2" align="left">{{ number_format(($total_shipping_amount+$total_amount),2,".",'') }}</td>
                                </tr>
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