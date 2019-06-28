@extends('layouts.user')

@section('title', 'New Order')

<style>
    .navbar-text{
        margin-bottom: -26px;
    }

    .right_menu a > img {
      margin-top: 10px;
    }
</style>


@section("navbar_right_item")
  <a class="nav_right_button" href="{{route('my_profile')}}" style="color: #fff; text-decoration: none;">Profile</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-11">
        <div class="row" id="order_form">
            <div class="col-md-2">
              <input type="file" id="print_file" style="width: 180px; margin-top: 18px;"/>
            </div>

            <div class="col-md-3" id="form_section">
              <div class="row">
                <div class="col-md-3">
                  <label for="pages">Pages</label>
                  <input type="number" name="pages" id="pages"/>
                </div>
                <div class="col-md-4">
                  <label for="total_sets">Total Set</label>
                  <input type="number" value="1" id="total_sets"/>
                </div>
                <div class="col-md-5">
                  <label for="total_pages">Total Pages</label>
                  <input type="number" id="total_pages" disabled/>
                </div>
              </div>
            </div>

            <div class="col-md-3" id="form_section">
              <div class="row">
                <div class="col-md-4">
                  <label for="color">Color</label>
                  <select id="color">
                      @foreach($print_color as $color)
                          <option value="{{ $color->id }}">{{ $color->title }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="print_type">Print Type</label>
                  <select id="print_type">
                      @foreach($print_type as $type)
                          <option value="{{ $type->id }}">{{ $type->title }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="print_side">Side</label>
                  <select id="print_side">
                      @foreach($print_side as $side)
                          <option value="{{ $side->id }}">{{ $side->title }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-2" id="form_section">
              <div class="row">
                <div class="col-md-4">
                  <label for="paper_size">Size</label>
                  <select id="paper_size">
                      @foreach($paper_size as $size)
                          <option value="{{ $size->id }}">{{ $size->title }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="col-md-8">
                  <label for="paper_type">Paper Type</label>
                  <select id="paper_type">
                      @foreach($paper_type as $type)
                          <option value="{{ $type->id }}">{{ $type->title }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-2" id="form_section">
              <div class="row">
                <div class="col-md-6">
                  <label for="rate">Rate</label>
                  <input type="number" id="rate" disabled/>
                </div>
                <div class="col-md-6">
                  <label for="price">Price</label>
                  <input type="number" id="price" disabled/>
                </div>
              </div>
            </div>

        </div>
        <button type="button" class="btn btn-secondary" id="add_to_table_button" style="width: 100px; height: 35px; float: right; margin-top: 10px;">Add</button>

        <table class="table order_table" style="margin-top: 100px; border-bottom: 1px solid #cecece;">

          <thead class="thead-dark">
            <tr>
              <th scope="col">File</th>
              <th scope="col">Page</th>
              <th scope="col">Set</th>
              <th scope="col">Total pages</th>
              <th scope="col">Color</th>
              <th scope="col">Print Type</th>
              <th scope="col">Side</th>
              <th scope="col">Size</th>
              <th scope="col">Paper Type</th>
              <th scope="col">Rate</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        <p style="float: right; margin-right: 80px;">Total Price: <span id="total_print_price">0 taka</span></p><br>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalPayment" id="send_order_button" style="width: 100px; height: 35px; float: right; margin-top: 50px;">Send</button>

    </div>

    <div class="col-md-1 right_menu">
        @include('right_menu')
    </div>
</div>
@endsection

@section('custom_js')
  <script src="{{ asset('content/js/place_order.js')}}"></script>
@endsection

<!--Payment Modal -->
<div class="modal fade" id="modalPayment" tabindex="-1" role="dialog" aria-labelledby="modalPaymentTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h5 class="modal-title" id="modalPaymenLongtTitle">Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="account_number">bKash <img src="https://www.kolpolok.com/img/bKash.jpg" width="25px" height="25px" style="margin-bottom: 5px;"/> Account No</label>
            <input type="number" class="form-control" id="account_number" required autofocus/>
          </div>
          <div class="form-group">
            <label for="trnxID">Transaction ID</label>
            <input type="text" class="form-control" id="trnxID"  required autofocus/>
          </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        <button type="submit" id="confirm_order_payment" class="btn btn-secondary">Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>
