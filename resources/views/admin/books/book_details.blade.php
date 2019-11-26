@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Book Details</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="content invoice">
              <div class="row invoice-info">
                @if (isset($book))                    
                <div class="col-sm-6 invoice-col">
                  <table class="table table-striped">
                    <caption>Book Deails</caption>
                    <tr>
                      <th style="width:150px;">Name : </th>
                      <td>{{$book->book_name}}</td>
                    </tr>                    
                    <tr>
                      <th>Author Name : </th>
                      <td>{{$book->author_name}}</td>
                    </tr> 
                    <tr>
                      <th>Publisher Name : </th>
                      <td>{{$book->publisher_name}}</td>
                    </tr>                   
                    <tr>
                      <th>Published Year : </th>
                      <td>{{$book->published_year}}</td>
                    </tr>
                    <tr>
                      <th>Catgory : </th>
                      <td> {{$book->category_name}} </td>
                    </tr>
                    <tr>
                      <th>Sub Category : </th>
                      <td> {{ $book->sub_cat_name }} </td>
                    </tr>
                    <tr>
                      <th>Book Language : </th>
                      <td> {{$book->language}} </td>
                    </tr>
                    <tr>
                      <th>Book Condition : </th>
                      <td> 
                        @if ($book->book_condition == 1)
                          <a class="btn btn-success">New</a>
                        @else
                          <a class="btn btn-info">Old</a>
                        @endif
                      </td>
                    </tr>                   
                    <tr>
                      <th>Book Type : </th>
                      <td>
                        @if ($book->book_type == 1)
                          <a class="btn btn-success">Academic</a>
                        @else
                          <a class="btn btn-info">Non Academic</a>
                        @endif
                      </td>
                    </tr> 
                    <tr>
                      <th>Stock : </th>
                      <td>{{$book->stock}}</td>
                    </tr>
                    <tr>
                      <th>M.R.P : </th>
                      <td>{{ number_format($book->mrp,2,".",'') }}</td>
                    </tr>
                    <tr>
                      <th>Selling Price : </th>
                      <td>{{ number_format($book->price,2,".",'') }}</td>
                    </tr>
                    <tr>
                      <th>Shipping Charge : </th>
                      <td>{{ number_format($book->shipping_charge,2,".",'') }}</td>
                    </tr>
                    <tr>
                      <th>Status : </th>
                      <td>
                        @if ($book->status == 1)
                          <a class="btn btn-primary">Activate</a>
                        @else
                          <a class="btn btn-danger">De-activate</a>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <th>Description : </th>
                      <td>{{ $book->description }}</td>
                    </tr>

                  </table>
                </div>
                @endif

                <div class="col-sm-6 invoice-col">
                   <table class="table table-striped">
                    @if ($book->user_id == 'A')
                      <caption>Seller Deails</caption>
                      <tr>
                        <th>Seller Name : </th>
                        <td>Admin</td>
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
                    @else
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
                    @endif
                  </table>

                  
                    <table class="table table-striped">
                      <caption>Book Image</caption>                     
                        <tr>
                          <td colspan="2">
                            <img src="{{asset('images/book_image/'.$book->book_image.'')}}" style="max-width:400px;" >
                          </td>
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