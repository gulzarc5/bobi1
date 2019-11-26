@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Product Details</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <table class="table table-striped">
                    <caption>Product Deails</caption>
                    <tr>
                      <th style="width:150px;">Name : </th>
                      <td>name product</td>
                    </tr>

                    
                      <tr>
                        <th>Tag Name : </th>
                        <td>fdgdf</td>
                      </tr>
                  

                    
                      <tr>
                        <th>Size & Fit : </th>
                        <td>ghjghj</td>
                      </tr>
                   
                    <tr>
                      <th>Brand : </th>
                      <td>gfhfg</td>
                    </tr>
                    <tr>
                      <th>Catgory : </th>
                      <td> fghfg </td>
                    </tr>
                    <tr>
                      <th>First Category : </th>
                      <td> fghfg </td>
                    </tr>
                    <tr>
                      <th>Second Category : </th>
                      <td> fghfg </td>
                    </tr>

                   
                    <tr>
                      <th>Short Description : </th>
                      <td>jgh</td>
                    </tr>
                   

                   
                    <tr>
                      <th>Long Description : </th>
                      <td>hyjg</td>
                    </tr>
                   

                  </table>
                </div>
                <div class="col-sm-6 invoice-col">
                   <table class="table table-striped">
                    <caption>Seller Deails</caption>
                    <tr>
                      <th>Seller Name : </th>
                      <td></td>
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

                  
                    <table class="table table-striped">
                      <caption>Product Image</caption>                     
                        <tr>
                          <td colspan="2"><img src="" height="100px" width="100px"></td>
                        </tr>                   
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