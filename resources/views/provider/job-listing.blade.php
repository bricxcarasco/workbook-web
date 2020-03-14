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
      
    @include('provider.parts.header')

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ asset('images/hero_1.jpg') }});" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Job Listing</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Job Listing</strong></span>
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

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">43,167 Job Listed</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">

          @foreach($listings as $listing)

            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
              <a href="{{ url('provider/job-listing/get') }}/{{ $listing->id }}"></a>
              <div class="job-listing-logo">
                @if (empty($listing->image))
                  <img src="{{ asset('images/default-job.png') }}" style="width:150px; height: 150px;" class="img-fluid rounded mb-4">
                @else
                  <img src="{{ asset('images') }}/{{ $listing->image }}" style="width:150px; height: 150px;" class="img-fluid rounded mb-4">
                @endif
              </div>

              <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                  <h2>{{ $listing->title }}</h2>
                  <strong>{{ $listing->details }}</strong>
                </div>
                <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                  <span class="icon-room"></span> {{ $listing->barangay.' '.$listing->municipality.' '.$listing->postal }}
                </div>
                <div class="job-listing-meta">
                  <h4>
                    @if ($listing->type == 1)
                      <span class="badge badge-primary">Part Time</span>
                    @elseif($listing->type == 2)
                      <span class="badge badge-info">Full Time</span>
                    @endif
                  </h4>
                </div>
              </div>
            </li>
            
            <br>

          @endforeach

        </ul>

      </div>
    </section>

    @extends('layouts.site.footer')

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
</div>
  
    @extends('layouts.site.script')
   
  </body>
</html>