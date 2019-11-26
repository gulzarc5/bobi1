@extends('seller.template.seller_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Megazine List</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="megazine_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Category</th>
                              <th>Name</th>
                              <th>Cost</th>
                              <th>Pages</th>
                              <th>Status</th>
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
    
            var table = $('#megazine_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('seller.ajax_megazine_list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'category_name', name: 'category_name',searchable: true},
                    {data: 'name', name: 'name' ,searchable: true},
                    {data: 'cost', name: 'cost' ,searchable: true},              
                    {data: 'pages', name: 'pages' ,searchable: true},                
                    {data: 'status_tab', name: 'status_tab',orderable: false, searchable: false},          
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>
    
 @endsection