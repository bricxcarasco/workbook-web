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
      
    @include('provider.parts.header', ['chat_counts' => $chat_counts, 'profile' => $profile])

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ asset('images/hero_1.jpg') }});" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Hiring Applications</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Hiring Applications</strong></span>
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

                          <table id="listingst" class="table table-striped table-hover display responsive">
                            <thead>
                              <tr>
                                <th>Applicant</th>
                                  <th>Gender</th>
                                  <th>Address</th>
                                  <th>Job Title</th>
                                  <th>Location</th>
                                  <th>Date</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($app_listings as $listing)
                                <tr>
                                    <td class="viewCom" id="{{ $listing }}"><a>{{ $listing->full_name }}</a></td>
                                    <td>
                                      @if ($listing->gender == 1)
                                        Male
                                      @elseif ($listing->gender == 2)
                                        Female
                                      @else
                                        Other
                                      @endif
                                    </td>
                                    <td>{{ $listing->address }}</td>
                                    <td>{{ $listing->title }}</td>
                                    <td>{{ $listing->barangay.' '.$listing->municipality.' '.$listing->postal }}</td>
                                    <td>{{ $listing->event_date }}</td>
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
                                      <button class="btn btn-primary" onclick="listingChange({{ $listing->id }}, {{ $listing->status }})">Update Status</button>
                                      <button class="btn btn-primary" onclick="viewAttach({{ $listing }})">View Attachment</button>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Applicant</th>
                                  <th>Gender</th>
                                  <th>Address</th>
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

                      <div class="tab-pane fade" id="quicks" role="tabpanel" aria-labelledby="quicks-tab">

                        <div class="table-responsive">

                          <table id="quickst" class="table table-striped table-hover display responsive">
                            <thead>
                              <tr>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Job Title</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($app_quicks as $quick)
                              <tr>
                                <td class="viewCom" id="{{ $quick }}"><a>{{ $quick->full_name }}</a></td>

                                    <td>
                                      @if ($listing->gender == 1)
                                        Male
                                      @elseif ($listing->gender == 2)
                                        Female
                                      @else
                                        Other
                                      @endif
                                    </td>
                                    <td>{{ $listing->address }}</td>
                                <td>
                                  @if (strlen(strip_tags($quick->request)) > 20)
                                    {{ substr(strip_tags($quick->request),0,20)."..." }}
                                  @else
                                    {{ strip_tags($quick->request) }}
                                  @endif
                                </td>
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
                                  <button class="btn btn-primary" onclick="quickChange({{ $quick->id }}, {{ $quick->status }})">Update Status</button>
                                  <button class="btn btn-primary" onclick="viewAttach({{ $quick }})">View Attachment</button>
                                </td>
                            </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Job Title</th>
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

    <div class="modal fade" id="quickModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <input type="hidden" name="id" id="id">
              <label for="">Employment Status</label>
              <select class="form-control" name="status" id="status">
                <option value="1">On Process</option>
                <option value="2">Interview</option>
                <option value="3">Pending</option>
                <option value="4">Cancelled</option>
                <option value="5">Hired</option>
                <option value="6">Failed</option>
              </select>

              <div class="applicationMessage" style="display:none;">
                <label for="">Start DateTime</label>
                <input class="form-control" type="datetime-local" id="start_date" name="start_date">

                <label for="">End DateTime</label>
                <input class="form-control" type="datetime-local" id="end_date" name="end_date">

                <label for="">Location</label>
                <input class="form-control" type="text" id="location" name="location">

                <label for="">Message</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>

                <label for="">Look for:</label>
                <input class="form-control" type="text" id="lookfor" name="lookfor">
              </div>

              <div class="applicationReason" style="display:none;">
                <label for="">Reason</label>
                <textarea class="form-control" name="reason" id="reason" cols="30" rows="10"></textarea>
              </div>

              <span class="spanMessage" style="color:red; display:none;">Make sure fields are not empty!</span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id ="updateQuick">Update Status</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="listingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <input type="hidden" name="id" id="id">
              <label for="">Employment Status</label>
              <select class="form-control" name="status" id="status">
                <option value="1">On Process</option>
                <option value="2">Interview</option>
                <option value="3">Pending</option>
                <option value="4">Cancelled</option>
                <option value="5">Hired</option>
                <option value="6">Failed</option>
              </select>

              <div class="applicationMessage" style="display:none;">
                <label for="">Start DateTime</label>
                <input class="form-control" type="datetime-local" id="start_date" name="start_date">

                <label for="">End DateTime</label>
                <input class="form-control" type="datetime-local" id="end_date" name="end_date">

                <label for="">Location</label>
                <input class="form-control" type="text" id="location" name="location">

                <label for="">Message</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>

                <label for="">Look for:</label>
                <input class="form-control" type="text" id="lookfor" name="lookfor">
              </div>

              <div class="applicationReason" style="display:none;">
                <label for="">Reason</label>
                <textarea class="form-control" name="reason" id="reason" cols="30" rows="10"></textarea>
              </div>

              <span class="spanMessage" style="color:red; display:none;">Make sure fields are not empty!</span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id ="updateListing">Update Status</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="viewCompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Job Seeker Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <style>
              .fa {
                color: #1b3d6c;
              }

              label .fa {
                padding-left: 5px;
                padding-right: 5px;
              }

              p span {
                padding-left: 15px;
              }
            </style>

            <fieldset style="padding: 10px;">

              <p for="">
                <i class="fa fa-2x fa-user" aria-hidden="true"></i> <span id="full_name"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-mercury" aria-hidden="true"></i> <span id="gender"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-address-book" aria-hidden="true"></i> <span id="address"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-adjust" aria-hidden="true"></i> <span id="civil_status"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-phone" aria-hidden="true"></i> <span id="telephone_number"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-mobile" aria-hidden="true"></i> <span id="mobile_number"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-graduation-cap" aria-hidden="true"></i> <span id="high_school"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-calendar" aria-hidden="true"></i> <span id="high_school_year"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-graduation-cap" aria-hidden="true"></i> <span id="college"></span>
              </p>

              <p for="">
                <i class="fa fa-2x fa-calendar" aria-hidden="true"></i> <span id="college_year"></span>
              </p>

            </fieldset>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="viewAttch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Attachment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form style="align: center;">

              <label for="">Valid ID</label>
              <div class="form-group">
                <img src="" alt="" id="valid_id" style="width: 300px; height: 300px;">
              </div>

              <div class="form-group">
                <label for="" id="labelRes"></label>
                <a target="_blank" href="" id="resume" download>Download Resume</a>
              </div>
              
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id ="updateQuick">Update Status</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

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
      $(function() {
        $('#listingModal').on('change', '#status', function() {
          if (this.value == "2" || this.value == "5") {
            $('#listingModal .applicationMessage').css('display', 'block');
            $('#listingModal .applicationReason').css('display', 'none');
          } else {
            $('#listingModal .applicationMessage').css('display', 'none');
            $('#listingModal .applicationReason').css('display', 'block');
          }
        });

        $('#quickModal').on('change', '#status', function() {
          if (this.value == "2" || this.value == "5") {
            $('#quickModal .applicationMessage').css('display', 'block');
            $('#quickModal .applicationReason').css('display', 'none');
          } else {
            $('#quickModal .applicationMessage').css('display', 'none');
            $('#quickModal .applicationReason').css('display', 'block');
          }
        });

        $("#listingModal").on('click', '#updateListing', function() {
          if ($("#listingModal #status").val() == 2 || $("#listingModal #status").val() == 5) {
            let id = $("#listingModal #id").val();
            let message = $("#listingModal #message").val()
            let lookfor = $("#listingModal #lookfor").val()
            let start_date = $("#listingModal #start_date").val()
            let end_date = $("#listingModal #end_date").val()
            let location = $("#listingModal #location").val()
            if (!message || !lookfor || !start_date || !end_date || !location) {
              $("#listingModal .spanMessage").css('display', 'block');
            } else {
              $("#listingModal .spanMessage").css('display', 'none');
              sendPositive(id, message, lookfor, start_date, end_date, location, $("#listingModal #status").val());
              $('#listingModal').modal('hide');
              $("#quickModal #message").val("")
              $("#quickModal #lookfor").val("")
              $("#quickModal #start_date").val("")
              $("#quickModal #end_date").val("")
              $("#quickModal #location").val("")
              $("#quickModal #reason").val("")
              alert('Successfully sent!');
            }
          } else {
            let id = $("#listingModal #id").val();
            let reason = $("#listingModal #reason").val()
            if (!reason) {
              $("#listingModal .spanMessage").css('display', 'block');
            } else {
              $("#listingModal .spanMessage").css('display', 'none');
              sendNegative(id, reason, $("#listingModal #status").val());
              $("#listingModal #message").val("")
              $("#listingModal #lookfor").val("")
              $("#listingModal #start_date").val("")
              $("#listingModal #end_date").val("")
              $("#listingModal #location").val("")
              $("#listingModal #reason").val("")
              $('#listingModal').modal('hide');
              alert('Successfully sent!');
            }
          }
        });

        $("#quickModal").on('click', '#updateQuick', function() {
          if ($("#quickModal #status").val() == 2 || $("#quickModal #status").val() == 5) {
            let id = $("#quickModal #id").val();
            let message = $("#quickModal #message").val()
            let lookfor = $("#quickModal #lookfor").val()
            let start_date = $("#quickModal #start_date").val()
            let end_date = $("#quickModal #end_date").val()
            let location = $("#quickModal #location").val()
            if (!message || !lookfor || !start_date || !end_date || !location) {
              $("#quickModal .spanMessage").css('display', 'block');
            } else {
              $("#quickModal .spanMessage").css('display', 'none');
              sendPositive(id, message, lookfor, start_date, end_date, location, $("#quickModal #status").val());
              $("#quickModal #message").val("")
              $("#quickModal #lookfor").val("")
              $("#quickModal #start_date").val("")
              $("#quickModal #end_date").val("")
              $("#quickModal #location").val("")
              $("#quickModal #reason").val("")
              $('#quickModal').modal('hide');
              alert('Successfully sent!');
            }
          } else {
            let id = $("#quickModal #id").val();
            let reason = $("#quickModal #reason").val()
            if (!reason) {
              $("#quickModal .spanMessage").css('display', 'block');
            } else {
              $("#quickModal .spanMessage").css('display', 'none');
              sendNegative(id, reason, $("#quickModal #status").val());
              $("#quickModal #message").val("")
              $("#quickModal #lookfor").val("")
              $("#quickModal #start_date").val("")
              $("#quickModal #end_date").val("")
              $("#quickModal #location").val("")
              $("#quickModal #reason").val("")
              $('#quickModal').modal('hide');
              alert('Successfully sent!');
            }
          }
        });

      });

      $(document).ready(function() {
          $('#listingst').DataTable({
            responsive: true
          });
          $('#quickst').DataTable({
            responsive: true
          });

          $(".viewCom").click(function() {
            let id = JSON.parse($(this).attr('id'));
            $('#viewCompanyModal').modal('show');
          $("#viewCompanyModal #full_name").text(id.full_name)
          $("#viewCompanyModal #gender").text(id.gender)
          $("#viewCompanyModal #address").text(id.address)
          $("#viewCompanyModal #civil_status").text(id.civil_status)
          $("#viewCompanyModal #telephone_number").text(id.telephone_number)
          $("#viewCompanyModal #mobile_number").text(id.mobile_number)
          $("#viewCompanyModal #high_school").text(id.high_school)
          $("#viewCompanyModal #high_school_year").text(id.high_school_year)
          $("#viewCompanyModal #college").text(id.college)
          $("#viewCompanyModal #college_year").text(id.college_year)
          });
      });

      function listingChange(id, status) {
        $("#listingModal").modal('show');
        $("#listingModal #id").val(id);
        $("#listingModal #status").val(status);
      }

      function quickChange(id, status) {
        $("#quickModal").modal('show');
        $("#quickModal #id").val(id);
        $("#quickModal #status").val(status);
      }

      function sendNegative(id, reason, status) {
        $.ajax({
          url: `/send/negative`,
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            id : id,
            reason: reason,
            status: status
          },
          success: function(data) {
            return data;
          }
        });
      }

      function sendPositive(id, message, lookfor, start_date, end_date, location, status) {
        let color = '#CD5C5C';
        if (status == 2)
          color = '#3498DB';
        else if (status == 5)
          color = '#2ECC71';
        $.ajax({
          url: `/send/positive`,
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            id : id,
            message: message,
            lookfor: lookfor,
            start_date: start_date,
            end_date: end_date,
            location: location,
            status: status,
            color: color
          },
          success: function(data) {
            return data;
          }
        });
      }

      function viewAttach(data) {
        // let jsonData = JSON.parse(data);
        let image = `/images/${data.valid_id}`;
        let resume = `/images/${data.resume}`;
        $("#viewAttch").modal('show');
        $("#viewAttch #valid_id").attr('src', image);
        $("#viewAttch #resume").attr('href', resume);
        $("#viewAttch #labelRes").text(data.resume);
        
      }

    </script>
   
  </body>
</html>