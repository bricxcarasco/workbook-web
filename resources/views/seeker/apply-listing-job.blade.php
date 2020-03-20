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
      
    @include('seeker.parts.header', ['chat_counts' => $chat_counts])

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ asset('images/hero_1.jpg') }});" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Full Time Job</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Full Time Job</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
        
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Apply Regular Listing</h2>
            <h4>{{ $listing->title }}</h4>
          </div>
        </div>

              <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                  <form action="/apply/listing_job" class="" method="POST" enctype="multipart/form-data">
                    @csrf
      
                    <div class="form-group">
                    
                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">

                    <label for="company-website-tw d-block">Upload Resume</label> <br>
                        {{-- <label class="btn btn-primary btn-md btn-file"> --}}
                            <input class="btn btn-primary btn-md btn-file" type="file" id="image_upload" value="{{ old('image_upload') }}" name="image_upload">
                        {{-- </label> --}}
                        @if ($errors->has('image_upload'))
                            <span style="display: block;" class="error invalid-feedback">{{ $errors->first('image_upload') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                    <label for="company-website-tw d-block">Valid ID</label> <br>
                        {{-- <label class="btn btn-primary btn-md btn-file"> --}}
                            <input class="btn btn-primary btn-md btn-file" type="file" id="identification" value="{{ old('identification') }}" name="identification">
                        {{-- </label> --}}
                        @if ($errors->has('identification'))
                            <span style="display: block;" class="error invalid-feedback">{{ $errors->first('identification') }}</span>
                        @endif
                    </div>
      
                    <div class="form-group">
                        <label class="text-black" for="fname">Date</label>
                        <input type="date" id="event_date" name="event_date" value="{{ old('event_date') }}" class="form-control">
                        @if ($errors->has('event_date'))
                            <span style="display: block;" class="error invalid-feedback">{{ $errors->first('event_date') }}</span>
                        @endif
                    </div>
      
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label class="text-black" for="message">Message</label> 
                        <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                        @if ($errors->has('message'))
                            <span style="display: block;" class="error invalid-feedback">{{ $errors->first('message') }}</span>
                        @endif
                      </div>
                    </div>
      
                    <div class="row form-group">
                      <div class="col-md-12">
                        <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
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
</html>