<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta lang="en">
	<meta lang="en">
	<title>@yield("title")</title>



	<link rel="stylesheet"  href="{{asset('content/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('content/css/style.css')}}">

</head>
<body>

    <div class="content">

		<!-- Header section -->
		<div class="header">

			<nav class="navbar navbar-expand-lg navbar-light">
				<h1 style="color: white; margin-left: 10px; font-size: 40px"><b>onlineprint</b></h1>

				<div class="navbar-text">
					@yield("navbar_right_item")

					@auth
						<a class="nav_right_button"
							onclick="event.preventDefault();
											document.getElementById('logout-form').submit();" style="color: #fff; margin-right: 10px; margin-bottom: -50px;">
							Sign Out
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					@endauth
				</div>
			</nav>

		</div>

		<!-- Content Section -->

        @if ($errors->has('message'))
        <p class="bg-success text-white text-center">
            {{$errors->first("message")}}
        </p>
        @endif

        @if (count($errors) > 0 && !$errors->has('message'))
        <p class="bg-danger text-white text-center">
            @foreach($errors->all() as $error)
                {{$error}}
                <br>
            @endforeach
        </p>
        @endif

		<div class="main_content">
			@yield('content');
		</div>

	</div>

	<!-- script items -->
	<script type="text/javascript" src="{{asset('content/js/jquery-3.4.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('content/js/bootstrap.min.js')}}"></script>

	@yield("custom_js")

</body>
</html>
