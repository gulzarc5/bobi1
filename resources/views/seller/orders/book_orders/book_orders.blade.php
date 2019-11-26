@extends('seller.template.seller_master')
@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Books Orders</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Order Id</th>
                              <th>Customer Order Id</th>
                              <th>Order By</th>
                              <th>Total Quantity</th>
                              <th>Shipping Charge</th>
                              <th>Amount</th>
                              <th>Order Status</th>
                              <th>Payment Method</th>
                              <th>Payment Status</th>                              
                              <th>Order Date</th>
                              <th>action</th>
                            </tr>
                          </thead>
                          <tbody>                       
                          </tbody>
                        </table>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
	</div>


 @endsection

@section('script')
     
     <script type="text/javascript">
         $(function () {
    
            var table = $('#size_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('seller.book_order_ajax_list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'order_id', name: 'order_id',searchable: true},
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'u_name', name: 'u_name' ,searchable: true},
                    {data: 'quantity', name: 'quantity' ,searchable: true},              
                    {data: 'shipping_charge', name: 'shipping_charge' ,searchable: true},  
                    {data: 'rate', name: 'rate', render:function(data, type, row){
                      return row.rate * row.quantity;           
                    }},      
                    {data: 'status_tab', name: 'status_tab',orderable: false, searchable: false}, 
                    {data: 'payment_method', name: 'payment_method', render:function(data, type, row){
                      if (row.payment_method == '1') {
                        return "<button class='btn btn-info'>COD</a>"
                      }else{
                        return "<button class='btn btn-primary'>Online</a>"
                      }                        
                    }},                  
                    {data: 'payment_status', name: 'payment_status', render:function(data, type, row){
                      if (row.payment_status == '1') {
                        return "<button class='btn btn-info'>Paid</a>"
                      }else{
                        return "<button class='btn btn-primary'>Pending</a>"
                      }                        
                    }},                
                    {data: 'created_at', name: 'created_at',orderable: false, searchable: false},                
                             
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>
    
 @endsection