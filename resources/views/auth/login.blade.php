<!DOCTYPE html>
<html lang="en">
<head>
	<title>WorkBook | Sign-In</title>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">	
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('images/workbook.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_temp/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_temp/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_temp/vendor/animate/animate.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ asset('login_temp/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_temp/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_temp/vendor/select2/select2.min.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ asset('login_temp/vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_temp/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_temp/css/main.css') }}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form p-l-55 p-r-55 p-t-178">
          @csrf
					<span class="login100-form-title">
						<a href="{{ url('/') }}" class="txtBRAND">WorkBook</a> | Sign In
          </span>
          
            <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email address">
              <input id="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Username">
              <span class="focus-input100"></span>

            </div>
            @if ($errors->has('email'))
              <div class="flex-col-c p-t-5 p-b-5" style="color: red !important; font-style: italic !important;">
                <span class="txtRED p-b-9">
                  {{ $errors->first('email') }}
                </span>
              </div>
            @endif
            
            <div class="wrap-input100 validate-input" data-validate = "Please enter password">
              <input id="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password" required>
              <span class="focus-input100"></span>

            </div>
            @if ($errors->has('password'))
              <div class="flex-col-c p-t-5 p-b-5" style="color: red !important; font-style: italic !important;">
                <span class="txtRED p-b-9">
                  {{ $errors->first('password') }}
                </span>
              </div>
            @endif
            
            <div class="p-t-13 p-b-13 p-l-40">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
      
                  <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                  </label>
              </div>
            </div>

            <div class="container-login100-form-btn">
              <button type="submit" class="login100-form-btn">
                {{ __('Login') }}
              </button>
            </div>
            
            <div class="flex-col-c p-t-40 p-b-40">
              <a href="{{ url('/forgot-password') }}" class="txt3 p-b-9">
                Forgot your password?
              </a>

              <span class="txt1 p-b-9">
                Don’t have an account?
              </span>
              
              <a href="{{ url('/register') }}" class="txt3">
                Sign up now
              </a>
            </div>

				</form>
			</div>
		</div>
	</div>
	
	
	<script src="{{ asset('login_temp/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('login_temp/vendor/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ asset('login_temp/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('login_temp/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('login_temp/vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('login_temp/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('login_temp/vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('login_temp/vendor/countdowntime/countdowntime.js') }}"></script>
	<script src="{{ asset('login_temp/js/main.js') }}"></script>

</body>
</html>