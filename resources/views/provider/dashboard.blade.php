@extends('layouts.header-user.header')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
            <h1 class="text-white font-weight-bold">Timeline</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Timeline</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <style>
      ul.timeline {
          list-style-type: none;
          position: relative;
      }
      ul.timeline:before {
          content: ' ';
          background: #d4d9df;
          display: inline-block;
          position: absolute;
          left: 29px;
          width: 2px;
          height: 100%;
          z-index: 400;
      }
      ul.timeline > li {
          margin: 20px 0;
          padding-left: 20px;
      }
      ul.timeline > li:before {
          content: ' ';
          background: white;
          display: inline-block;
          position: absolute;
          border-radius: 50%;
          border: 3px solid #22c0e8;
          left: 20px;
          width: 20px;
          height: 20px;
          z-index: 400;
      }
    </style>

    <section class="site-section"  style="padding-top: 2rem;padding-bottom: 2rem;">>
      <div class="container">
            
        <div class="container mt-5 mb-5">
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <h4>Announcements</h4>
              <ul class="timeline">
                @foreach ($announcements as $announcement)
                <li>
                  <a href="#">{{ $announcement->title }}</a>
                  <a href="#" class="float-right">{{ $announcement->created_date }}</a>
                  <p>{{ $announcement->message }}</p>
                  <a href="#">From: Administrator</a>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>

      </div>
    </section>

    @extends('layouts.site.footer')
  
</div>
  
    @extends('layouts.site.script')
   
  </body>
</html>