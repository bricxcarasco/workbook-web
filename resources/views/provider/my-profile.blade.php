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
      
    @include('provider.parts.header', ['chat_counts' => $chat_counts])

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
        
        <form class="p-4 p-md-5 border rounded" action="/provider/my_profile" method="POST" enctype="multipart/form-data">
          @csrf
        
          <div class="row align-items-center mb-5">

          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>Company Description</h2>
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
                <img src="{{ asset('images') }}/{{ $provider->image }}" style="width: 200px; height: 200px;" class="img-fluid mb-4 w-20 rounded-circle"><br>
                <label for="company-website-tw d-block">Upload Featured Image</label> <br>
                <label class="btn btn-primary btn-md btn-file">
                  Browse File<input type="file" name="image_upload">
                </label>
                @if ($errors->has('image_upload'))
                    {{ $errors->first('image_upload') }}
                @endif
              </div>

              <input type="hidden" name="id" value="{{ $provider->id }}">

              <div class="form-group">
                <label for="business_name">Business Name</label>
                <input type="text" class="form-control" name="business_name" value="{{ $provider->business_name }}" placeholder="Business Name">
                @if ($errors->has('business_name'))
                    {{ $errors->first('business_name') }}
                @endif
              </div>

              <div class="form-group">
                <label for="business_type">Business Type</label>
                <input type="text" class="form-control" name="business_type" value="{{ $provider->business_type }}" placeholder="Business Type">
                @if ($errors->has('business_type'))
                    {{ $errors->first('business_type') }}
                @endif
              </div>

              <div class="form-group">
                <label for="email_address">Email Address</label>
                <input type="text" class="form-control" name="email_address" value="{{ $provider->email_address }}" placeholder="Email Address">
                @if ($errors->has('email_address'))
                    {{ $errors->first('email_address') }}
                @endif
              </div>
              
              <div class="form-group">
                <label for="mailing_address">Location</label>
                <input type="text" class="form-control" name="mailing_address" value="{{ $provider->mailing_address }}" placeholder="Location">
                @if ($errors->has('mailing_address'))
                    {{ $errors->first('mailing_address') }}
                @endif
              </div>

              <div class="form-group">
                <label for="profile_desc">Profile Description</label>
                <input type="text" class="form-control" name="profile_desc" value="{{ $provider->profile_desc }}" placeholder="Profile Description">
                @if ($errors->has('profile_desc'))
                    {{ $errors->first('profile_desc') }}
                @endif
              </div>

              <h3 class="text-black my-5 border-bottom pb-2">Social Media Acounts</h3>

              <div class="form-group">
                <label for="facebook">Facebook Username (Optional)</label>
                <input type="text" class="form-control" name="facebook" value="{{ $provider->facebook }}" placeholder="Facebook">
                @if ($errors->has('facebook'))
                    {{ $errors->first('facebook') }}
                @endif      
              </div>

              <div class="form-group">
                <label for="twitter">Twitter Username (Optional)</label>
                <input type="text" class="form-control" name="twitter" value="{{ $provider->twitter }}" placeholder="Twitter">
                @if ($errors->has('twitter'))
                    {{ $errors->first('twitter') }}
                @endif
              </div>

              <div class="form-group">
                <label for="instagram">Instagram Account (Optional)</label>
                <input type="text" class="form-control" name="instagram" value="{{ $provider->instagram }}" placeholder="Instagram">
                @if ($errors->has('affiliation'))
                    {{ $errors->first('affiliation') }}
                @endif
              </div>

              <div class="form-group">
                <label for="affiliation">Affiliation</label>
                <input type="text" class="form-control" name="affiliation" value="{{ $provider->affiliation }}" placeholder="Affiliation">
                @if ($errors->has('affiliation'))
                    {{ $errors->first('affiliation') }}
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