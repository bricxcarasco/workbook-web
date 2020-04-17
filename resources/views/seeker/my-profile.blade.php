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
            <h1 class="text-white font-weight-bold">My Profile</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>My Profile</strong></span>
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
        
        <form class="p-4 p-md-5 border rounded" action="/seeker/my_profile" method="POST" enctype="multipart/form-data">
          @csrf
        
          <div class="row align-items-center mb-5">

          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>Seeker Information</h2>
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
                <img src="{{ asset('images') }}/{{ $seeker->image }}" style="width: 200px; height: 200px;" class="img-fluid mb-4 w-20 rounded-circle"><br>
                <label for="company-website-tw d-block">Upload Featured Image</label> <br>
                <label class="">
                  Browse File
                </label>
                  <input type="file" class="form-control" name="image_upload">
                @if ($errors->has('image_upload'))
                    {{ $errors->first('image_upload') }}
                @endif
              </div>

              <input type="hidden" name="id" value="{{ $seeker->id }}">

              <div class="form-group">
                <label for="full_name">Business Name</label>
                <input type="text" class="form-control" name="full_name" value="{{ $seeker->full_name }}" placeholder="Business Name">
                @if ($errors->has('full_name'))
                    {{ $errors->first('full_name') }}
                @endif
              </div>

              <div class="form-group">
                <label for="birth_date">Birth Date</label>
                <input type="text" class="form-control" name="birth_date" value="{{ $seeker->birth_date }}" placeholder="Birth Date">
                @if ($errors->has('birth_date'))
                    {{ $errors->first('birth_date') }}
                @endif
              </div>

              <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" class="form-control" name="gender" value="{{ $seeker->gender }}" placeholder="Gender">
                @if ($errors->has('gender'))
                    {{ $errors->first('gender') }}
                @endif
              </div>

              <div class="form-group">
                <label for="civil_status">Civil Status</label>
                <input type="text" class="form-control" name="civil_status" value="{{ $seeker->civil_status }}" placeholder="Civil Status">
                @if ($errors->has('civil_status'))
                    {{ $errors->first('civil_status') }}
                @endif
              </div>

              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" value="{{ $seeker->address }}" placeholder="Email Address">
                @if ($errors->has('address'))
                    {{ $errors->first('address') }}
                @endif
              </div>

              <div class="form-group">
                <label for="telephone_number">Telephone Number</label>
                <input type="text" class="form-control" name="telephone_number" value="{{ $seeker->telephone_number }}" placeholder="Email telephone_number">
                @if ($errors->has('telephone_number'))
                    {{ $errors->first('telephone_number') }}
                @endif
              </div>

              <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" class="form-control" name="mobile_number" value="{{ $seeker->mobile_number }}" placeholder="Email mobile_number">
                @if ($errors->has('mobile_number'))
                    {{ $errors->first('mobile_number') }}
                @endif
              </div>

              <div class="form-group">
                <label for="email_address">Email Address</label>
                <input type="text" class="form-control" name="email_address" value="{{ $seeker->email_address }}" placeholder="Email Address">
                @if ($errors->has('email_address'))
                    {{ $errors->first('email_address') }}
                @endif
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Educational Background</h3>
              
              <div class="form-group">
                <label for="high_school">High School</label>
                <input type="text" class="form-control" name="high_school" value="{{ $seeker->high_school }}" placeholder="high_school">
                @if ($errors->has('high_school'))
                    {{ $errors->first('high_school') }}
                @endif      
              </div>

              <div class="form-group">
                <label for="high_school_year">Year Graduated</label>
                <input type="text" class="form-control" name="high_school_year" value="{{ $seeker->high_school_year }}" placeholder="high_school_year">
                @if ($errors->has('high_school_year'))
                    {{ $errors->first('high_school_year') }}
                @endif
              </div>

              <div class="form-group">
                <label for="college">College</label>
                <input type="text" class="form-control" name="college" value="{{ $seeker->college }}" placeholder="college">
                @if ($errors->has('college'))
                    {{ $errors->first('college') }}
                @endif
              </div>

              <div class="form-group">
                <label for="college_year">Year Graduated</label>
                <input type="text" class="form-control" name="college_year" value="{{ $seeker->college_year }}" placeholder="college_year">
                @if ($errors->has('college_year'))
                    {{ $errors->first('college_year') }}
                @endif
              </div>
          </div>

         
        </div>
        <div class="row align-items-center mb-5">
          
          <div class="col-lg-4 ml-auto">
            <div class="row">
              <div class="col-6">
                
              </div>
              <div class="col-6">
                <button class="btn btn-block btn-primary btn-md">Save Details</button>
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