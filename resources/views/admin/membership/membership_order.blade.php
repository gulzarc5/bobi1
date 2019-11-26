@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Membership Orders</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Order Id</th>
                              <th>Order By</th>
                              <th>Membership Name</th>
                              <th>Price</th>
                              <th>Payment Request Id</th>
                              <th>Payment Id</th>                              
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
                ajax: "{{ route('admin.membership_order_list_ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id', id: 'id',id: true},
                    {data: 'u_name', name: 'u_name' ,searchable: true},
                    {data: 'membership_name', name: 'membership_name' ,searchable: true},              
                    {data: 'price', name: 'price' ,searchable: true},    
                    {data: 'payment_request_id', name: 'payment_request_id' ,searchable: true},  
                    {data: 'payment_id', name: 'payment_id', searchable: true}, 
                    {data: 'payment_status', name: 'payment_status', render:function(data, type, row){
                      if (row.payment_status == '1') {
                        return "<button class='btn btn-danger'>Failed</a>"
                      }else{
                        return "<button class='btn btn-primary'>Paid</a>"
                      }                        
                    }},                
                    {data: 'created_at', name: 'created_at',orderable: false, searchable: false}, 
                ]
            });
            
        });
     </script>
    
 @endsection