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

    <section class="site-section" id="next-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <form action="/provider/quick-job-request" method="POST">
                        @csrf

                        <input type="hidden" name="tag" value="{{ $category->id }}">

                        <div class="row form-group">
                                
                            <div class="col-md-12">
                                <label class="text-black" for="fname">Request</label>
                                <textarea id="editor1" name="request"></textarea>
                            </div>
                            @if ($errors->has('request'))
                                <span style="display: block;" class="error invalid-feedback">{{ $errors->first('request') }}</span>
                            @endif
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-black" for="fname">Date</label>
                                <input type="date" id="event_date" name="event_date" class="form-control">
                                @if ($errors->has('event_date'))
                                    <span style="display: block;" class="error invalid-feedback">{{ $errors->first('event_date') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="text-black" for="lname">Time</label>
                                <input type="time" id="event_time" name="event_time" class="form-control">
                                @if ($errors->has('event_time'))
                                    <span style="display: block;" class="error invalid-feedback">{{ $errors->first('event_time') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            
                            <div class="col-md-12">
                                <label class="text-black" for="subject">Location</label> 
                                <input type="text" id="location" name="location" class="form-control">
                                @if ($errors->has('location'))
                                    <span style="display: block;" class="error invalid-feedback">{{ $errors->first('location') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-md text-white">Save Quick Job Request</button>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="col-lg-5 ml-auto">
                    <div class="p-4 mb-3 bg-white">

                        @if (empty($category->image))
                            <img src="{{ asset('images/default-job.png') }}" style="width:150px; height: 150px;" class="img-fluid">
                        @else
                            <img src="{{ asset('images') }}/{{ $category->image }}" style="width:150px; height: 150px;" class="img-fluid">
                        @endif

                        <br><br>

                        <h3 class="font-weight-bold">{{ $category->title }}</h3>

                        <p class="mb-0 font-weight-bold">Description</p>
                        <p class="mb-4">{{ $category->description }}</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @extends('layouts.site.footer')

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
</div>
  
    <script>
        CKEDITOR.replace('editor1');
    </script>

    @extends('layouts.site.script')

  </body>
</html>