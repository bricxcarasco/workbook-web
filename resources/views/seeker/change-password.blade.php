@extends('layouts.header-user.header')

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
      
    @include('seeker.parts.header', ['chat_counts' => $chat_counts, 'profile' => $profile])

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ asset('images/hero_1.jpg') }});" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Change Password</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Change Password</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        
        <form class="p-4 p-md-5 border rounded" action="/seeker/change-password" method="POST">
          @csrf
        
          <div class="row align-items-center mb-5">

          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>Change Password</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">

              <div class="form-group">
                <label for="current_password">Current Passwrod</label>
                <input type="password" class="form-control" name="current_password" value="{{ old('current_password') }}" placeholder="Current Password">
                @if ($errors->has('current_password'))
                    {{ $errors->first('current_password') }}
                @endif
              </div>

              <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" name="new_password" value="{{ old('new_password') }}" placeholder="New Password">
                @if ($errors->has('new_password'))
                    {{ $errors->first('new_password') }}
                @endif
              </div>

              <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Confirm Password">
                @if ($errors->has('confirm_password'))
                    {{ $errors->first('confirm_password') }}
                @endif
              </div>
          
          </div>

         
        </div>
        <div class="row align-items-center mb-5">
          
          <div class="col-lg-4 ml-auto">
            <div class="row">
              <div class="col-4">
                
              </div>
              <div class="col-8">
                <button class="btn btn-block btn-primary btn-md">Change Password</button>
              </div>
            </div>
          </div>
        </div>
        
      </form>

      </div>
    </section>

    @extends('layouts.site.footer')
  
</div>
  
    @extends('layouts.site.script')
   
  </body>
</html>