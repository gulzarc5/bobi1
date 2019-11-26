@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Project Orders</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Order Id</th>
                              <th>Project Name</th>
                              <th>Order By</th>
                              <th>Total Amount</th>
                              <th>Payment Status</th>                              
                              <th>Order Date</th>
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
                ajax: "{{ route('seller.project_order_ajax_list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'name', name: 'name' ,searchable: false,orderable: false},   
                    {data: 'u_name', name: 'u_name' ,searchable: false,orderable: false}, 
                    {data: 'price', name: 'price' ,searchable: true},                    
                    {data: 'payment_status', name: 'payment_status', render:function(data, type, row){
                      if (row.payment_status == '1') {
                        return "<button class='btn btn-info'>Paid</a>"
                      }else{
                        return "<button class='btn btn-primary'>Pending</a>"
                      }                        
                    }},                
                    {data: 'created_at', name: 'created_at',orderable: false, searchable: false},                
                ]
            });
            
        });
     </script>
    
 @endsection