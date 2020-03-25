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
      
    @include('provider.parts.header', ['chat_counts' => $chat_counts, 'profile' => $profile])

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ asset('images/hero_1.jpg') }});" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Quick Job Request</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Quick Job Request</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">{{ $categories->count() }} Categories Listed</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">

          @foreach($categories as $category)
            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
              <a href="{{ url('/provider/quick-job-request') }}/{{ $category->id }}"></a>
              <div class="job-listing-logo">
                @if (empty($category->image))
                  <img src="{{ asset('images/default-job.png') }}" style="width:150px; height: 150px;" class="img-fluid rounded mb-4">
                @else
                  <img src="{{ asset('images') }}/{{ $category->image }}" style="width:150px; height: 150px;" class="img-fluid rounded mb-4">
                @endif
              </div>

              <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                  <h2>{{ $category->title }}</h2>
                  <strong>{{ $category->description }}</strong>
                </div>
                <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                  <span class="icon-room"></span> Anywhere in Laguna
                </div>
                <div class="job-listing-meta">
                  <span class="badge badge-info">Quick Job Request</span>
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