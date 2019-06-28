@extends('layouts.user')


@section('title', "CR1 Sign Up")


@section('navbar_right_item')

    <form class="row right_nav_menu" id="login-form" method="post" action="{{ route('login') }}">
        @csrf
        <div class="col-md-4">
            <label for="email" style="color:white">Email or Phone</label>
            <br>
            <input type="text" name="email" required autofocus>

        </div>

        <div class="col-md-4">
            <label for="password" style="color: white">Password</label><br>
            <input type="password" name="password" required autofocus>
            <br>
            <a href="forgot.html" style="font-size: 13px; color: #bcbcbc;">Forgotten Account?</a>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn-login" style="margin-top: 25px;" >Login</button>
        </div>
    </form>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-7">
            <img src="{{asset('content/images/project1.jpg')}}" height="350px" width="90%" alt="cover">
        </div>

        <div class="col-md-5">
            <h4 style="color: #000; font-size: 32px;"><b>Create a new account</b></h4>
            <h6 style="font-size: 18px;"><b>it's free and always will be</b></h6>

            <form id="registration-form" method="post" action="{{ route('register') }}">  
                @csrf     
                <div style="border: 2px solid #ddd; padding: 10px;">
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-5">
                            <label for="name" style="color: #000;">Name</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="name" required autofocus><br>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-5">
                            <label for="phone" style="color: #000;">Mobile number</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="phone" required autofocus><br>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-5">
                            <label for="email" style="color: #000;">E-mail</label>
                        </div>
                        <div class="col-md-5">
                            <input type="email" name="email"  required autofocus><br>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-5">
                            <label for="password" style="color: #000;">New password</label>
                        </div>
                        <div class="col-md-5">
                            <input type="password" name="password" required autofocus><br>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-5">
                            <label for="password_confirmation" style=" color: #000;">Confirm password</label>
                        </div>
                        <div class="col-md-5">
                            <input type="password" name="password_confirmation" required autofocus><br>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary" style="margin-top: 50px; width: 120px;">Sign up</button>
            
            </form>
        </div>
    </div>

@endsection 
