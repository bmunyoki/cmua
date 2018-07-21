<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}"/>
<!--===============================================================================================-->

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('/images/hepta.png');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form" method="POST" action="{{ url('/login') }}">
					<meta name="_token" content="{{ csrf_token() }}" /> 
            		<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
					<span class="login100-form-title p-b-59">
						Change Password
					</span>

					@if($errors->any())
						<span style="color: red; padding-bottom: 10px">{{ $errors->first() }}</span>
					@endif
					<div>
						<span class="response"></span>
					</div>

					<div class="wrap-input100">
						<span class="label-input100">Old Password</span>
						<input class="input100" type="password" name="old" id="oldPass" placeholder="Old Password">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100">
						<span class="label-input100">New Password</span>
						<input class="input100" type="password" name="new" id="newPass" placeholder="New Password">
						<span class="focus-input100"></span>
                    </div>
                    
                    <div class="wrap-input100">
						<span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" name="confirm" id="confirmPass" placeholder="Confirm Password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" id="changePassword">
								Change Password
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>