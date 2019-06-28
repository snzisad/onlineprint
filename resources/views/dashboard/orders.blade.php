@extends('layouts.user')

@section('title', 'Orders')

<style>
    .navbar-text{
        margin-bottom: -26px;
    }

    .right_menu a > img {
      margin-top: 10px;
    }

    .content_title{
        font-size: 20px;
        font-weight: bold;
        color: #000;
    }

    .row{
        margin-bottom: 2px;
    }

    .section_title{
      background: #3b5998;
      color: #fff;
      text-align: center;
      padding: 2px;
      margin-bottom: 10px;
    }

    .order_list{
      border: 1px solid #3b5998;
      padding: 10px;
      color: #000;
    }

    .order_list .order_date, .order_price{
        float: right;
    }

    .modal-body a{
      margin: 10px;
    }


</style>


@section("navbar_right_item")
  <a class="nav_right_button" data-toggle="modal" data-target="#modalMenu" style="color: #fff">Menu</a>
@endsection

@section('content')

@if(isset($order))
  <div class="row">
    <div class="col-md-11">
        <div style="float:right">
            <a href="{{ route('envelop' , ['id'=>$user->id]) }}" class="btn btn-secondary btn-sm" target="_blank">Print Envelop</a>
            <a href="{{ route('remove_order' , ['id'=>$order->id]) }}" onclick="return confirm('Are you sure you want to delete this order?');" class="btn btn-danger btn-sm">Delete Record</a>
        </div>
      <div class="row" style="margin-top: 50px;">
          <div class="col-md-3">
            <div class="section_title">Recent Orders</div>

            @foreach($orders as $data)
              <a href="{{ route('order_details' , ['id'=>$data->id]) }}">

                <div class="order_list">
                    <div>
                      <span class="order_id"><b>ID: </b> #{{ $data->id }}</span>
                      <span class="order_date"> {{ $data->created_at }} </span>
                    </div>

                    <div>
                      <span class="order_page"><b>Page: </b> {{ $data->total_page }} </span>
                      <span class="order_price"><b>Price: </b> {{ $data->price }} taka</span>
                    </div>
                </div>

              </a>

            @endforeach

          </div>
          <div class="col-md-2">
            <div class="section_title">User Information</div>

                <img id="picture" src="https://www.loginradius.com/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" width="100px" height="100px" class="img-responsive">

                <div class="address" style="margin-top: 10px; margin-bottom: 20px;">
                  <div>
                    <b>Name: </b> {{ $user->name }}
                  </div>
                  <div>
                    <b>Phone: </b> {{ $user->phone }}
                  </div>
                  <div>
                    <b>Email: </b> {{ $user->email }}
                  </div>
                  <div>
                    <b>District: </b> {{ $user->home_address->district->title  }}
                  </div>
                  <div>
                    <b>Division: </b> {{ $user->home_address->division->title  }}
                  </div>
                  <div>
                    <b>Upazila: </b> {{ $user->home_address->upazila->title }}
                  </div>
                  <div>
                    <b>Post Office: </b> {{ $user->home_address->post_office->title }}
                  </div>

            </div>

            <div class="section_title">Peyment Information</div>

              <div>
                <b>bKash Account: </b> {{ $order->payment->account }}
              </div>
              <div>
                <b>Transaction ID: </b>{{ $order->payment->trnx_id }}
              </div>
              <div>
                <b>Amount: </b> {{ $order->price }} taka
              </div>

          </div>
          <div class="col-md-7">
            <div class="section_title">Order Details</div>

              <div class="order_list">

                  <div>
                    <span class="order_id"><b>ID: </b> #{{ $order->id }}</span>
                    <span class="order_date"><b>Date: </b> {{ $order->created_at }} </span>
                  </div>

                  <div>
                    <span class="order_page"><b>Total Page: </b> {{ $order->total_page }} </span>
                    <span class="order_price"><b>Total Price: </b> {{ $order->price }} taka</span>
                  </div>

              </div>

              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Page</th>
                    <th scope="col">Set</th>
                    <!-- <th scope="col">Total Page</th> -->
                    <th scope="col">Color</th>
                    <th scope="col">Print Type</th>
                    <th scope="col">Side</th>
                    <th scope="col">Size</th>
                    <th scope="col">Paper Type</th>
                    <!-- <th scope="col">Rate</th>
                    <th scope="col">Price</th> -->
                  </tr>
                </thead>
                <tbody>
                  @foreach($order->items as $data)

                    <tr  onclick="location.href='{{ route('download' , ['type'=>'files', 'file'=>$data->file->title]) }}'" style="cursor:pointer;">
                      <td scope="row"> {{ $data->id }}</th>
                      <td>{{ $data->page }}</td>
                      <td>{{ $data->set }}</td>
                      <!-- <td>{{ $data->total_page }}</td> -->
                      <td>{{ $data->color->title }}</td>
                      <td>{{ $data->print_type->title }}</td>
                      <td>{{ $data->print_side->title }}</td>
                      <td>{{ $data->paper_size->title }}</td>
                      <td>{{ $data->paper_type->title }}</td>
                      <!-- <td>{{ $data->rate }}</td>
                      <td>{{ $data->price }}</td> -->
                    </tr>

                  @endforeach
                </tbody>
              </table>

          </div>
      </div>
    </div>

    <div class="col-md-1 right_menu">
        @include('right_menu')
    </div>
</div>
@else
No Data
@endif

@endsection

@section('custom_js')
  <script src="{{ asset('content/js/order_list.js')}}"></script>

  @if(isset($order))
  <script>
    @if($user->profile_picture)
        var url = "{{asset('storage/pictures/')}}/{{ $user->profile_picture->picture }}";
        $("#picture").attr("src", url);
    @endif
  </script>
  @endif

@endsection




<!--Menu Modal -->
<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="modalPaymentTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h5 class="modal-title" id="modalPaymenLongtTitle">Menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_division" data-target="#modalNewDataTitle">Add Division</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_district" data-target="#modalNewData">Add District</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_upazila" data-target="#modalNewData">Add Upazila</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_post_office" data-target="#modalNewData">Add Post Office</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_courier" data-target="#modalNewDataTitle">Add Courier</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_branch" data-target="#modalNewData">Add Branch</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_color" data-target="#modalNewDataTitle">Add Color</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_print_type" data-target="#modalNewDataTitle">Add Print Type</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_print_side" data-target="#modalNewDataTitle">Add Print Side</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_paper_size" data-target="#modalNewDataTitle">Add Paper Size</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_paper_type" data-target="#modalNewDataTitle">Add Paper Type</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" id="btn_add_print_rate" data-target="#modalNewRate">Add Print Rate</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!--New Title Modal -->
<div class="modal fade" id="modalNewDataTitle" tabindex="-1" role="dialog" aria-labelledby="modalPaymentTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="modalNewDataTitleForm" method="POST" action="{{ route('new_division') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalNewDataTitle_header">New Division</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title"  required autofocus/>
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <button type="submit" id="confirm_order_payment" class="btn btn-secondary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--New Data Modal -->
<div class="modal fade" id="modalNewData" tabindex="-1" role="dialog" aria-labelledby="modalPaymentTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="modalNewDataForm" method="POST" action="#">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalNewData_Header">New District</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label id="option_select_box_title" for="option_select_box">Division</label>
            <select class="form-control" id="option_select_box" name="parent" required autofocus>
            </select>
          </div>
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required autofocus/>
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <button type="submit" id="confirm_order_payment" class="btn btn-secondary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--New Data Modal -->
<div class="modal fade" id="modalNewRate" tabindex="-1" role="dialog" aria-labelledby="modalPaymentTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="modalNewRateForm" method="POST" action="{{ route('new_print_rate') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalNewRate_Header">Print Rate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="option_color">Color</label>
            <select class="form-control" id="option_color" name="print_color_id" required autofocus>
            </select>
          </div>
          <div class="form-group">
            <label for="option_print_type">Print Type</label>
            <select class="form-control" id="option_print_type" name="print_type_id" required autofocus>
            </select>
          </div>
          <div class="form-group">
            <label for="option_print_side">Print Side</label>
            <select class="form-control" id="option_print_side" name="print_side_id" required autofocus>
            </select>
          </div>
          <div class="form-group">
            <label for="option_print_size">Paper Size</label>
            <select class="form-control" id="option_print_size" name="paper_size_id" required autofocus>
            </select>
          </div>
          <div class="form-group">
            <label for="paper_type_id">Paper Type</label>
            <select class="form-control" id="option_paper_type" name="paper_type_id" required autofocus>
            </select>
          </div>
          <div class="form-group">
            <label for="title">Rate (per page)</label>
            <input type="number" class="form-control" name="rate" step="any" required autofocus/>
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <button type="submit" id="confirm_order_payment" class="btn btn-secondary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
