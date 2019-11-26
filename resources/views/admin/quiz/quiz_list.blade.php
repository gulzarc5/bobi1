@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Quiz List</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Name</th>
                              <th>Category</th>
                              <th>Pages</th>
                              <th>Status</th>
                              <th>Approve Status</th>
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
                ajax: "{{ route('admin.ajax_quiz_list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name' ,searchable: true},
                    {data: 'cat_name', name: 'cat_name' ,searchable: true},
                    {data: 'pages', name: 'pages' ,searchable: true},  
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-primary'>Enabled</a>"
                      }else{
                        return "<button class='btn btn-danger'>Disabled</a>"
                      }                        
                    }},      
                    {data: 'approve_status', name: 'approve_status', render:function(data, type, row){
                      if (row.approve_status == '1') {
                        return "<button class='btn btn-primary'>Yes</a>"
                      }else{
                        return "<button class='btn btn-danger'>No</a>"
                      }                        
                    }},         
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>
    
 @endsection