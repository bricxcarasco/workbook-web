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

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Quick Job List</h2>
            <h4>{{ $quick_jobs->count() }} record/s</h4>
          </div>
        </div>

        <div id="updateSuccessAlert" class="alertMessage alert alert-success alert-dismissible fade show" style="display: none;" role="alert">
          Quick job request information successfully updated!
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>

        <div id="deleteSuccessAlert" class="alertMessage alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
          Quick job request successfully deleted!
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>


        @foreach($quick_jobs as $quick_job)
          <div class="card">
            <h5 class="card-header" style="background-color: rgba(0, 0, 0, 0.16) !important;">{{ $quick_job->title }}</h5>
            <div class="card-body">

                @if (empty($quick_job->image))
                  <img src="{{ asset('images/default-job.png') }}" style="width:150px; height: 150px;" class="img-fluid rounded mb-4 float-right">
                @else
                  <img src="{{ $quick_job->image }}" style="width:150px; height: 150px;" class="img-fluid rounded mb-4 float-right">
                @endif

                <h5 class="card-title">{{ $quick_job->description }}</h5>
                <p class="card-text">
                  @if (strlen(strip_tags($quick_job->request)) > 100)
                    {{ substr(strip_tags($quick_job->request),0,100)."..." }}
                  @else
                    {{ strip_tags($quick_job->request) }}
                  @endif
                </p>

                <button id="{{ $quick_job->id }}" onclick="view(this.id)" class="btn btn-primary">View More Info</button>
                <button id="{{ $quick_job->id }}" onclick="remove(this.id)" class="btn btn-danger">Delete</button>

                <div style="margin-top: 20px;" class="row form-group">
                  <h5>
                    @if ($quick_job->status == 0)
                      <span class="badge badge-pill badge-info">Available</span>
                    @else
                      <span class="badge badge-pill badge-danger">Not Available</span>
                    @endif
                  </h5>
                </div>

              </div>
            </div>
          <br>
        @endforeach

      </div>
    </section>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
                  <div class="row form-group">
                          
                      <input type="hidden" name="id" id="id">

                      <div class="col-md-12">
                          <label class="text-black" for="fname">Request</label>
                          <textarea id="editor1" name="request" class="request"></textarea>
                      </div>
                      <span style="display: none;" class="error invalid-feedback">Request body is required.</span>
                  </div>
                  
                  <div class="row form-group">
                      <div class="col-md-6 mb-3 mb-md-0">
                          <label class="text-black" for="fname">Date</label>
                          <input type="date" id="event_date" name="event_date" class="form-control">
                          <span style="display: none;" class="error invalid-feedback">Event date is required.</span>
                      </div>
                      <div class="col-md-6">
                          <label class="text-black" for="lname">Time</label>
                          <input type="time" id="event_time" name="event_time" class="form-control">
                          <span style="display: none;" class="error invalid-feedback">Event time is required.</span>
                      </div>
                  </div>

                  <div class="row form-group">
                      
                      <div class="col-md-12">
                          <label class="text-black" for="subject">Location</label> 
                          <input type="text" id="location" name="location" class="form-control">
                          <span style="display: none;" class="error invalid-feedback">Location is requied.</span>
                      </div>
                  </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id ="save">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <label>Are you sure you want to delete this job?</label>
              <input type="hidden" id="id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id ="deleteSeeker">Delete</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    @extends('layouts.site.footer')

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
</div>
  
    @extends('layouts.site.script')
   
    <script>
      CKEDITOR.replace('editor1');
    </script>
    <script type="text/javascript">

      $(document).ready(function() {

        $("#editModal").on('click', '#save', function() {
          $.ajax({
            url: `/quick_job_list/put`,
            type: 'PUT',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              id : $('#editModal #id').val(),
              request : CKEDITOR.instances['editor1'].getData(),
              event_date : $('#editModal #event_date').val(),
              event_time : $('#editModal #event_time').val(),
              location : $('#editModal #location').val()
            },
            success: function(data) {
              if (data == 'Success') {
                $('#editModal').modal('hide');
                $('.alertMessage').hide('slow');
                $('#updateSuccessAlert').show('slow');
              }
            }
          });
        });

        $('#deleteModal').on('click', '#deleteSeeker', function() {
          let id = $(this).attr('id');
            $.ajax({
              url: `/quick_job_list/delete`,
              type: 'PUT',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                id: $('#deleteModal #id').val()
              },
              success: function(data) {
                if (data == 'Success') {
                  $('#deleteModal').modal('hide');
                  $('.alertMessage').hide('slow');
                  $('#deleteSuccessAlert').show('slow');
                  location.reload();
                }
              }
            });
        });

      });

      function view(id) {
        $.ajax({
          url: `/quick_job_list/get/${id}`,
          type: 'GET',
          success: function(data) {
            if (data == 'Empty') {
              $('.alertMessage').hide('slow');
              $('#emptySuccessAlert').show('slow');
            } else {
              $('#editModal').modal('show');
              $('#editModal #id').val(data.id);
              CKEDITOR.instances.editor1.setData(data.request);
              $('#editModal #event_date').val(data.event_date);
              $('#editModal #event_time').val(data.event_time);
              $('#editModal #location').val(data.location);
            }
          }
        });
      }

      function remove(id) {
        $('#deleteModal').modal('show');
        $('#deleteModal #id').val(id);
      }
    </script>

  </body>
</html>