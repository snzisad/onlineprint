<!DOCTYPE html>
<html>
  <head>
      <title>Envelop</title>

    	<link rel="stylesheet"  href="{{asset('content/css/bootstrap.min.css')}}">

      <style>
        .container{
            background: #fff;
            border: 1px solid #3b5998;
            padding: 20px;
            margin-top: 50px;

            color: #000;
            font-size: 18px;
        }

        .section_border{
          border-left: 2px solid #3b5998;
          height: 100%;
          margin: 10px;
        }

        .section_title{
            color: #000;
            font-size: 20px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            max-width: 300px;
            border-bottom: 1px solid #3b5998;
        }

      </style>

  </head>

  <body>

    <div class="container">

      <div class="row">

        <div class="col-md-4">
          <p class="section_title"> From </p>
          <p> www.onlineprint.com </p>
        </div>

        <div class="col-md-1">
          <p class="section_border"></p>
        </div>

        <div class="col-md-7">
            <p class="section_title"> To </p>

            <div class="row">
                <div class="col-md-5">
                  Name
                </div>

                <div class="col-md-7">
                    : {{ $user-> name}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  Mobile Number
                </div>

                <div class="col-md-7">
                    : {{ $user-> phone }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  Division
                </div>

                <div class="col-md-7">
                    : {{ $user-> home_address->division->title }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  District
                </div>

                <div class="col-md-7">
                    : {{ $user-> home_address->district->title }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  P.S/Upazila
                </div>

                <div class="col-md-7">
                    : {{ $user-> home_address->upazila->title }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  Post Office
                </div>

                <div class="col-md-7">
                    : {{ $user-> home_address->post_office->title }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  Vill/Town/Road/House/Flat
                </div>

                <div class="col-md-7">
                    : {{ $user-> home_address->others }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  Courier
                </div>

                <div class="col-md-7">
                    : {{ $user-> courier_address->courier->title }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  Branch
                </div>

                <div class="col-md-7">
                    : {{ $user-> courier_address->branch->title }}
                </div>
            </div>
        </div>

      </div>

    </div>

  </body>
</html>

<script>
  window.print();
</script>
