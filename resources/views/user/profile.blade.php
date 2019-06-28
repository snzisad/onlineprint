@extends('layouts.user')

@section('title', 'My Profile')

@section('content')

<style>
    .navbar-text{
        margin-bottom: -26px;
    }
    .content_title{
        font-size: 20px;
        font-weight: bold;
        color: #000;
    }

    .row{
        margin-bottom: 2px;
    }
</style>

<div class="container">
    <form method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6" style="margin-top: 10px;">
                <p class="text-center content_title">Address for home delivery</p>
                <hr>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-3">
                        <img id="picture" src="https://www.loginradius.com/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" width="120px" height="120px" class="img-responsive">

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" >Name</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="name" value="{{ $user->name }}"><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="phone">Mobile number</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone"  value="{{ $user->phone }}" disabled><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email" >E-mail</label>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email"  value="{{ $user->email }}" disabled><br>
                            </div>
                        </div>

                        <input type="file" id="input_image" class="form-control" name="picture" style="background: none;" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="division" >Select Division</label>
                    </div>
                    <div class="col-md-6">
                        <select name="division" id="division" required autofocus>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="district" >Select District</label>
                    </div>
                    <div class="col-md-6">
                        <select name="district" id="district" required autofocus>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="upazila" >P.S./Upazila</label>
                    </div>
                    <div class="col-md-6">
                        <select name="upazila" id="upazila" required autofocus>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="post_office" >Post Office</label>
                    </div>
                    <div class="col-md-6">
                        <select name="post_office" id="post_office" required autofocus>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="others" >Vill/Town/Road/House/Flat</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="others" id="others" required autofocus />
                    </div>
                </div>

            </div>

            <div class="col-md-6" style="margin-top: 10px;">
                <p class="text-center content_title">Address for courier delivery</p>
                <hr>

                <div class="row" style="margin-top: 100px;">
                    <div class="col-md-6">
                        <label for="courier" >Select Courier</label>
                    </div>
                    <div class="col-md-6">
                        <select name="courier" id="courier" required autofocus>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="branch" >Select Branch</label>
                    </div>
                    <div class="col-md-6">
                        <select name="branch" id="branch" required autofocus>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-secondary" style="height: 32px; width: 100px; font-size: 15px; padding: 5px; font-weight: bold; float: right; margin-top: 100px;">Save</button>

            </div>
        </div>

    </form>
</div>

@endsection

@section('custom_js')

<script type="text/javascript" src="{{ asset('content/js/profile.js')}}"></script>

<script>

    @if($user->profile_picture)
        var url = "{{asset('storage/pictures/')}}/{{ $user->profile_picture->picture }}";
        $("#picture").attr("src", url);
    @endif


    @if($user->home_address)
        $("#others").val('{{ $user->home_address->others }}');
    @endif

</script>

@endsection
