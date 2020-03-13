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
        
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">43,167 Job Listed</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">

          
          
        </ul>

        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Showing 1-7 Of 43,167 Jobs</span>
          </div>
          <div class="col-md-6 text-center text-md-right">
            <div class="custom-pagination ml-auto">
              <a href="#" class="prev">Prev</a>
              <div class="d-inline-block">
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              </div>
              <a href="#" class="next">Next</a>
            </div>
          </div>
        </div>

      </div>
    </section>

    @extends('layouts.site.footer')

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
      $(document).ready(function() {
        getJobs();
      });

      function getJobs() {
        $.ajax({
          url: `/job_listing/all`,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            console.log(data);
            let divApp = '';
            data.forEach( (element) => {
                divApp = divApp + `
                    <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                    <a href="job-single.html"></a>
                    <div class="job-listing-logo">
                      <img src="{{ asset('images/job_logo_1.jpg') }}" style="width:150px; height: 150px;" class="img-fluid">
                    </div>

                    <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                      <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                        <h2>Product Designer</h2>
                        <strong>Adidas</strong>
                      </div>
                      <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                        <span class="icon-room"></span> New York, New York
                      </div>
                      <div class="job-listing-meta">
                        <span class="badge badge-danger">Part Time</span>
                      </div>
                    </div>
                  </li>`;
            });
            $(".job-listings").append(divApp);
          }
        });
      }
    </script>
</div>
  
    @extends('layouts.site.script')
   
  </body>
</html>