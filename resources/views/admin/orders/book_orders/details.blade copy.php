@extends('admin.template.admin_master')

@section('content')
<style>
  .order-sub-head{
    font-size: 19px;
    font-variant: small-caps;
    font-weight: bold;
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
                <div class="col-sm-6 invoice-col">
                  <table class="table table-striped">
                    <caption class="order-sub-head">Order Deails</caption>
                    <tr>
                      <th style="width:150px;">Order Id : </th>
                      <td>1</td>
                    </tr>
                    <tr>
                      <th>Order By : </th>
                      <td>Gulzar</td>
                    </tr>
                    <tr>
                      <th>Total Quantity : </th>
                      <td>3</td>
                    </tr>                   
                    <tr>
                      <th>Shipping Charge : </th>
                      <td>20.00</td>
                    </tr>
                    <tr>
                      <th>Total Amount : </th>
                      <td> 100.00 </td>
                    </tr>
                    <tr>
                      <th>Payment Method : </th>
                      <td> Online </td>
                    </tr>
                    <tr>
                      <th>Payment Request Id : </th>
                      <td> dfgdfgdsf234324 </td>
                    </tr>
                    <tr>
                      <th>Payment Id : </th>
                      <td>dsfsd23423</td>
                    </tr>
                    <tr>
                      <th>Order Status : </th>
                      <td> pending </td>
                    </tr>
                    <tr>
                      <th>Payment Status : </th>
                      <td>paid</td>
                    </tr>
                    <tr>
                      <th>Order On : </th>
                      <td>25-11-2019</td>
                    </tr>   
                  </table>
                </div>

                <div class="col-sm-6 invoice-col">
                  <table class="table table-striped">
                   <caption class="order-sub-head">Shipping Address</caption>
                   <tr>
                     <th>Name : </th>
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
                </div>
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
                                    <th class="column-title">Book Quantity</th>
                                    <th class="column-title">Price</th>
                                    <th class="column-title">Shipping Charge</th>
                                    <th class="column-title">Total</th>                                    
                                    <th class="column-title">Action</th>
                                </tr>
                            </thead>
                                <tr>
                                  <td colspan="8" align="right">Total</td>
                                  <td colspan="2" align="left">100.00</td>
                                </tr>
                                <tr>
                                  <td colspan="8" align="right">Shipping Charge</td>
                                  <td colspan="2" align="left">100.00</td>
                                </tr>
                                <tr>
                                  <td colspan="8" align="right">Grand Total</td>
                                  <td colspan="2" align="left">100.00</td>
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