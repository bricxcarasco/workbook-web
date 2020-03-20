<!doctype html>
<html lang="en">
  <head>
    <title>WorkBook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>WorkBook &mdash; Job Site</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ asset('css/custom-bs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/line-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">    
  </head>
  <body id="top">

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>


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
            <h1 class="text-white font-weight-bold">Ongoing Applications</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Ongoing Applications</strong></span>
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

        <div class="col-md-12 gedf-main">

          <div class="card gedf-card">

              <div class="card-header">

                  <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="jobs-tab" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs" aria-selected="true">Job Listing</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="quicks-tab" data-toggle="tab" href="#quicks" role="tab" aria-controls="quicks" aria-selected="false">Quick Job Request</a>
                      </li>
                  </ul>

              </div>

              <div class="card-body">
                  <div class="tab-content" id="myTabContent">

                      <div class="tab-pane fade show active" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
                          
                        <div class="table-responsive">

                          <table id="listingst" class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th>ID</th>
                                  <th>Job Title</th>
                                  <th>Location</th>
                                  <th>Salary</th>
                                  <th>Date</th>
                                  <th>Slots</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($app_listings as $listing)
                                <tr>
                                    <td>{{ $listing->id }}</td>
                                    <td>{{ $listing->title }}</td>
                                    <td>{{ $listing->barangay.' '.$listing->municipality.' '.$listing->postal }}</td>
                                    <td>{{ 'Php. '.$listing->min_offer.' - Php. '.$listing->max_offer }}</td>
                                    <td>{{ $listing->event_date }}</td>
                                    <td>{{ $listing->slots }}</td>
                                    <td>
                                      @if ($listing->status == 1)
                                      <span class="badge badge-pill badge-secondary">On Process</span>
                                      @elseif ($listing->status == 2)
                                      <span class="badge badge-pill badge-warning">Interview</span>
                                      @elseif ($listing->status == 3)
                                      <span class="badge badge-pill badge-primary">Pending</span>
                                      @elseif ($listing->status == 4)
                                      <span class="badge badge-pill badge-info">Cancelled</span>
                                      @elseif ($listing->status == 5)
                                      <span class="badge badge-pill badge-success">Hired</span>
                                      @elseif ($listing->status == 6)
                                      <span class="badge badge-pill badge-danger">Failed</span>
                                      @else
                                      <span class="badge badge-pill badge-dark">Other</span>
                                      @endif  
                                    </td>
                                    <td>
                                      @if ($listing->status == 1 || $listing->status == 2 || $listing->status == 3)
                                          <a href="{{ route('cancel_listing', ['id' => $listing->id]) }}" onclick="event.preventDefault(); document.getElementById('cancel_listing-form{{ $listing->id }}').submit();" class="btn btn-warning">Cancel</a>
                                      @else
                                        @if ($listing->status == 4)
                                        <span class="badge badge-pill badge-info">Cancelled</span>
                                        @elseif ($listing->status == 5)
                                        <span class="badge badge-pill badge-success">Hired</span>
                                        @elseif ($listing->status == 6)
                                        <span class="badge badge-pill badge-danger">Failed</span>
                                        @else
                                        <span class="badge badge-pill badge-dark">Other</span>
                                        @endif  
                                      @endif
                                    </td>
                                    <form id="cancel_listing-form{{ $listing->id }}" action="{{ route('cancel_listing', ['id' => $listing->id]) }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                                </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th>ID</th>
                                  <th>Job Title</th>
                                  <th>Location</th>
                                  <th>Salary</th>
                                  <th>Date</th>
                                  <th>Slots</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                            </tfoot>
                          </table>                                  

                        </div>

                      </div>

                      <div class="tab-pane fade" id="quicks" role="tabpanel" aria-labelledby="quicks-tab">

                        <div class="table-responsive">

                          <table id="quickst" class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Job Title</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($app_quicks as $quick)
                              <tr>
                                <td>{{ $quick->id }}</td>
                                <td>
                                  @if (strlen(strip_tags($quick->request)) > 40)
                                    {{ substr(strip_tags($quick->request),0,40)."..." }}
                                  @else
                                    {{ strip_tags($quick->request) }}
                                  @endif
                                <td>{{ $quick->location }}</td>
                                <td>{{ $quick->event_date }}</td>
                                <td>
                                  @if ($quick->status == 1)
                                  <span class="badge badge-pill badge-secondary">On Process</span>
                                  @elseif ($quick->status == 2)
                                  <span class="badge badge-pill badge-warning">Interview</span>
                                  @elseif ($quick->status == 3)
                                  <span class="badge badge-pill badge-primary">Pending</span>
                                  @elseif ($quick->status == 4)
                                  <span class="badge badge-pill badge-info">Cancelled</span>
                                  @elseif ($quick->status == 5)
                                  <span class="badge badge-pill badge-success">Hired</span>
                                  @elseif ($quick->status == 6)
                                  <span class="badge badge-pill badge-danger">Failed</span>
                                  @else
                                  <span class="badge badge-pill badge-dark">Other</span>
                                  @endif  
                                </td>
                                <td>
                                  @if ($quick->status == 1 || $quick->status == 2 || $quick->status == 3)
                                  <a href="{{ route('cancel_quick', ['id' => $quick->id]) }}" onclick="event.preventDefault(); document.getElementById('cancel_quick-form{{ $quick->id }}').submit();" class="btn btn-warning" id="cancelledlisting">Cancel</a>
                                  @else
                                    @if ($quick->status == 4)
                                    <span class="badge badge-pill badge-info">Cancelled</span>
                                    @elseif ($quick->status == 5)
                                    <span class="badge badge-pill badge-success">Hired</span>
                                    @elseif ($quick->status == 6)
                                    <span class="badge badge-pill badge-danger">Failed</span>
                                    @else
                                    <span class="badge badge-pill badge-dark">Other</span>
                                    @endif  
                                  @endif
                                </td>
                                <form id="cancel_quick-form{{ $quick->id }}" action="{{ route('cancel_quick', ['id' => $quick->id]) }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                            </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th>ID</th>
                                  <th>Job Title</th>
                                  <th>Location</th>
                                  <th>Date</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                            </tfoot>
                          </table>    

                        </div>

                      </div>

                  </div>
              </div>
          </div>

      </div>

      </div>
    </section>

    @extends('layouts.site.footer')
  
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('js/stickyfill.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>

<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/quill.min.js') }}"></script>

<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
      $(document).ready(function() {
          $('#listingst').DataTable();

          $('#quickst').DataTable();
      } );
    </script>
   
  </body>
</html>