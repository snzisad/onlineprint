@extends('layouts.user')

@section('title', 'Verification')

@section('content')

<div class="jumbotron text-center" style="font-size: 25px; color: #000;">
    <p>We have sent a verification code in our email<br>
        To verify please type the code in the box.</p>
    <br>
    <form method="POST">
        @csrf
        <label for="Code" style="font-size: 25px; color: #000;">Code : </label>
        <input type="number" name="code" required autofocus>
        <br><br>
        <button type="submit" class="btn btn-secondary" style="width: 120px; font-size: 20px; font-weight: bold;">Verify</button>
    </form>
</div>

@endsection
