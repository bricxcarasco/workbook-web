@extends('layouts.header-user.header')

<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>

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
            <h1 class="text-white font-weight-bold">Post Job</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Post Job</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
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

        <form class="p-4 p-md-5 border rounded" action="/provider/post-job" method="POST" enctype="multipart/form-data" style="background: aliceblue;">
          @method('PUT')
          @csrf
          <div class="row align-items-center mb-5">
            <div class="col-lg-8 mb-4 mb-lg-0">
              <div class="d-flex align-items-center">
                <div>
                  
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="row">
                <div class="col-6">
                  
                </div>
                <div class="col-6">
                  <button class="btn btn-block btn-primary btn-md">Save Job</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-lg-12">
              
                <h3 class="text-black mb-5 border-bottom pb-2">Job Details</h3>
                
                  <input type="hidden" name="id" value="{{ $listing->id }}">

                  <div class="form-group">
                    <label for="company-website-tw d-block">Upload Feature Image</label> <br>
                    {{-- <label class="btn btn-primary btn-md btn-file"> --}}
                      <input class="btn btn-primary btn-md btn-file" type="file" id="image_upload" name="image_upload">
                    {{-- </label> --}}
                    @if ($errors->has('image_upload'))
                        <span style="display: block;" class="error invalid-feedback">{{ $errors->first('image_upload') }}</span>
                    @endif
                  </div>

                  <div class="row form-group">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="text-black" for="fname">Date</label>
                        <input type="date" id="event_date" name="event_date" value="{{ $listing->event_date }}" class="form-control">
                        @if ($errors->has('event_date'))
                            <span style="display: block;" class="error invalid-feedback">{{ $errors->first('event_date') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="text-black" for="lname">Time</label>
                        <input type="time" id="event_time" name="event_time" value="{{ $listing->event_time }}" class="form-control">
                        @if ($errors->has('event_time'))
                            <span style="display: block;" class="error invalid-feedback">{{ $errors->first('event_time') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                  <label for="email">Job Title</label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ $listing->title }}" placeholder="Job Title">
                  @if ($errors->has('title'))
                      <span style="display: block;" class="error invalid-feedback">{{ $errors->first('title') }}</span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="job-description">Job Description</label>
                  <textarea id="editor1" name="details">{{ $listing->details }}</textarea>
                  @if ($errors->has('details'))
                      <span style="display: block;" class="error invalid-feedback">{{ $errors->first('details') }}</span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="job-type">Job Type</label>
                  <select class="form-control border rounded" id="type" name="type" data-style="btn-black" data-width="100%" title="Select Job Type">
                    <option value="1">Part Time</option>
                    <option value="2">Full Time</option>
                  </select>
                  @if ($errors->has('type'))
                      <span style="display: block;" class="error invalid-feedback">{{ $errors->first('type') }}</span>
                  @endif
                </div>

                <div class="row form-group">
                  <div class="col-md-6 mb-3 mb-md-0">
                      <label class="text-black" for="fname">Minimum Offer</label>
                      <input type="text" id="min_offer" name="min_offer" value="{{ $listing->min_offer }}" class="form-control" placeholder="Salary offer range">
                      @if ($errors->has('min_offer'))
                          <span style="display: block;" class="error invalid-feedback">{{ $errors->first('min_offer') }}</span>
                      @endif
                  </div>
                  <div class="col-md-6">
                      <label class="text-black" for="lname">Maximum Offer</label>
                      <input type="text" id="max_offer" name="max_offer" value="{{ $listing->max_offer }}" class="form-control" placeholder="Salary offer range">
                      @if ($errors->has('max_offer'))
                          <span style="display: block;" class="error invalid-feedback">{{ $errors->first('max_offer') }}</span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="job-region">Experience</label>
                  <select class="form-control border rounded" id="experience" name="experience" data-style="btn-black" data-width="100%" title="Select Experience Requirements">
                    <option value="1">No experience</option>
                    <option value="2">Fresh Graduate</option>
                    <option value="3">1 year</option>
                    <option value="4">2 to 3 years</option>
                    <option value="5">3 to 5 years</option>
                    <option value="6">5 to 10 years</option>
                    <option value="7">10 years above</option>
                      </select>
                  @if ($errors->has('experience'))
                    <span style="display: block;" class="error invalid-feedback">{{ $errors->first('experience') }}</span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="job-title">Municipaility</label>
                  <input type="text" class="form-control" id="municipality" value="{{ $listing->municipality }}" name="municipality" placeholder="e.g. Sta Cruz">
                  @if ($errors->has('municipality'))
                      <span style="display: block;" class="error invalid-feedback">{{ $errors->first('municipality') }}</span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="job-location">Barangay</label>
                  <input type="text" class="form-control" id="barangay" value="{{ $listing->barangay }}" name="barangay" placeholder="e.g. Brgy. Santisima">
                  @if ($errors->has('barangay'))
                      <span style="display: block;" class="error invalid-feedback">{{ $errors->first('barangay') }}</span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="company-name">Postal Code</label>
                  <input type="text" class="form-control" id="postal" value="{{ $listing->postal }}" name="postal" placeholder="e.g. 4009">
                  @if ($errors->has('postal'))
                      <span style="display: block;" class="error invalid-feedback">{{ $errors->first('postal') }}</span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="company-tagline">Vacancy Slot</label>
                  <input type="number" class="form-control" id="slots" value="{{ $listing->slots }}" name="slots" placeholder="Slots available">
                  @if ($errors->has('slots'))
                      <span style="display: block;" class="error invalid-feedback">{{ $errors->first('slots') }}</span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="company-website-tw d-block">Upload DTI Permit</label> <br>
                  {{-- <label class="btn btn-primary btn-md btn-file"> --}}
                    <input class="btn btn-primary btn-md btn-file" type="file" value="{{ $listing->dti }}" id="dti" name="dti">
                  {{-- </label> --}}
                  @if ($errors->has('dti'))
                      <span style="display: block;" class="error invalid-feedback">{{ $errors->first('dti') }}</span>
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
                  <button class="btn btn-block btn-primary btn-md">Save Job</button>
                </div>
              </div>
            </div>
          </div>
        
        </form>

      </div>
    </section>

    @extends('layouts.site.footer')
  
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
</div>
    <script>
      let listing = {!! json_encode($listing->toArray()) !!};
      console.log(listing.experience);
      $("#experience").val(listing.experience);
      $("#type").val(listing.type);
    </script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
  
    @extends('layouts.site.script')
   
  </body>
</html>