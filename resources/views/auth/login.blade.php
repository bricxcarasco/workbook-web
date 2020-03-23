<!DOCTYPE html>
<html lang="en">
<head>
	<title>WorkBook | Sign-In</title>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">	
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="{{ asset('login_temp/images/icons/favicon.ico') }}"/>
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

{{-- 
@extends('layouts.site.header-login')
    

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    
    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="{{ url('/') }}">WorkBook</a></div>
          
          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li class="d-lg-none"><a href="{{ url('/register') }}">Sign Up</a></li>
            </ul>
          </nav>

          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
              <a href="{{ url('/register') }}" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Sign Up</a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ asset('login_temps/hero_1.jpg') }});" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Sign Up/Login</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Log In</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section"  style="padding-top: 3rem;padding-bottom: 3rem;">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2 class="mb-4">Log In To WorkBook</h2>

              <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <div class="form-group row">
                      <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                      <div class="col-md-6">
                          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                          @if ($errors->has('email'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                      <div class="col-md-6">
                          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                          @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-md-6 offset-md-4">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                              <label class="form-check-label" for="remember">
                                  {{ __('Remember Me') }}
                              </label>
                          </div>
                      </div>
                  </div>

                  <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                              {{ __('Login') }}
                          </button>

                          @if (Route::has('password.request'))
                              <a class="btn btn-link" href="{{ route('password.request') }}">
                                  {{ __('Forgot Your Password?') }}
                              </a>
                          @endif
                      </div>
                  </div>
              </form>

          </div>
        </div>
      </div>
    </section>
    
    @extends('layouts.site.footer')
  
</div>

    @extends('layouts.site.script')
   
  </body>
</html> --}}