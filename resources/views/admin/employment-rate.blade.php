<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WorkBook | Employment Rate</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css">
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('admin.parts.navbar', ['chats' => $chat_list, 'chat_count' => $chat_counts, 'profile' => $profile])

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Employment Rate</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Employment Rate</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">

            <div class="card card-primary">

              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Employment Rate
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#employment-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content p-0">
                  <div class="chart tab-pane active" id="employment-chart"
                        style="position: relative; height: 300px;">
                      <canvas id="employment-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                    </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                  </div>  
                </div>
              </div>
            </div>

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Application List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <div class="table-responsive">

                  <table id="employment" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Seeker</th>
                        <th>Provider</th>
                        <th>Job Type</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($employments as $employment)
                      <tr>
                        <td>{{ $employment->full_name }}</td>  
                        <td>{{ $employment->business_name }}</td>  
                        <td>
                          @if ($employment->type == 1)
                          <span class="badge badge-pill badge-info">Regular Job</span>
                          @else
                          <span class="badge badge-pill badge-warning">Request Job</span>
                          @endif
                        </td>  
                        <td>{{ $employment->event_date }}</td>  
                        <td>
                          @if ($employment->status == 1)
                          <span class="badge badge-pill badge-secondary">On Process</span>
                          @elseif ($employment->status == 2)
                          <span class="badge badge-pill badge-warning">Interview</span>
                          @elseif ($employment->status == 3)
                          <span class="badge badge-pill badge-primary">Pending</span>
                          @elseif ($employment->status == 4)
                          <span class="badge badge-pill badge-info">Cancelled</span>
                          @elseif ($employment->status == 5)
                          <span class="badge badge-pill badge-success">Hired</span>
                          @elseif ($employment->status == 6)
                          <span class="badge badge-pill badge-danger">Failed</span>
                          @else
                          <span class="badge badge-pill badge-dark">Other</span>
                          @endif  
                        </td>
                        <td><button id="{{ $employment }}" class="viewMore">View More</button></td>  
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>Seeker</th>
                          <th>Provider</th>
                          <th>Job</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                    </tfoot>
                  </table>    

                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (right) -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Application Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 0rem;">
          
          <table class="table table-striped">
            <tbody>
               <tr>
                  <td colspan="1">
                     <form class="well form-horizontal">
                        <fieldset>

                          <label>Seeker Information</label>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="full_name" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="birth_date" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-mercury" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="gender" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-adjust" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="civil_status" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-address-book" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="address" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="telephone_number" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="mobile_number" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="email_address" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="high_school" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="high_school_year" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="college" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="college_year" disabled>
                          </div>

                        </fieldset>
                     </form>
                  </td>
                  <td colspan="1">
                     <form class="well form-horizontal">
                        <fieldset>

                          <label>Provider Information</label>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="business_name" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-building" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="business_type" disabled>
                          </div>

                          <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="mailing_address" disabled>
                          </div>

                          <label>Job Information</label>

                          <div id="regular" style="display:none;">

                            <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                              </div>
                              <input type="text" class="form-control" id="title" disabled>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-info" aria-hidden="true"></i></span>
                              </div>
                              <input type="text" class="form-control" id="details" disabled>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                              </div>
                              <input type="text" class="form-control" id="offer" disabled>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                              </div>
                              <input type="text" class="form-control" id="experience" disabled>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                              </div>
                              <input type="text" class="form-control" id="location" disabled>
                            </div>

                          </div>

                          <div id="request" style="display:none;">

                            <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                              </div>
                              <input type="text" class="form-control" id="tag" disabled>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                              </div>
                              <input type="text" class="form-control" id="request_location" disabled>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-info" aria-hidden="true"></i></span>
                              </div>
                              <input type="text" class="form-control" id="request_request" disabled>
                            </div>

                          </div>

                            

                        </fieldset>
                     </form>
                  </td>
               </tr>
            </tbody>
         </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2020 WorkBook.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

  <script type="text/javascript">

    var salesChartCanvas = document.getElementById('employment-chart-canvas').getContext('2d');
    var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
    
    var salesChartData = {
      labels  : ['On Process', 'Interview', 'Pending', 'Cancelled', 'Hired', 'Failed', 'Other'],
      datasets: [
        {
          label               : 'Employee Rate',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : {!! json_encode($total_counts) !!}
        }
      ]
    }
    
    var pieData = {
      labels: ['On Process', 'Interview', 'Pending', 'Cancelled', 'Hired', 'Failed', 'Other'],
      datasets: [
        {
          data: {!! json_encode($total_counts) !!},
          backgroundColor : ['#007bff', '#6f42c1', '#e83e8c', '#fd7e14', '#ffc107', '#28a745','#17a2b8'],
        }
      ]
    }


    var pieOptions = {
      legend: {
        display: true
      },
      maintainAspectRatio : false,
      responsive : true,
    }

    var salesChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }

    var salesChart = new Chart(salesChartCanvas, { 
        type: 'line', 
        data: salesChartData, 
        options: salesChartOptions
      }
    )

    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    });

  </script>

<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form>
          <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary" style="margin-bottom: 0rem;">
              <div class="card-header">
                <h5 class="card-title">Direct Chat</h5>

                <div class="card-tools">
                  
                  {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button> --}}
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <input type="hidden" id="receiverId">
                <div id="chatMessagesDiv" class="direct-chat-messages" style="padding: 30px !important;">

                </div>
              </div>
              <div class="card-footer">
                  <div class="input-group">
                    <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control" required>
                    <span class="input-group-append">
                      <button type="button" id="sendMessage" class="btn btn-primary">Send</button>
                    </span>
                  </div>
              </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {

    $('#chatModal').on('click', '#sendMessage', function() {
      let receiverId = $("#chatModal #receiverId").val();
      let message = $("#chatModal #message").val();
      if (message) {
        $.ajax({
          url: `/chat/send`,
          type: 'POST',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            receiver : receiverId,
            message : message
          },
          success: function(data) {
            console.log(data);
            if (data == 'Success') {
              $("#chatModal #message").val("");
              getMessages(receiverId);
              
            }
          }
        });
      }
    });

  });

  function chat(id) {
    $("#chatModal").modal("show");
    $("#chatModal .direct-chat-messages").html('');
    getMessages(id);
  }

  function getMessages(id) {
    $("#chatModal #receiverId").val(id);
    $.ajax({
      url: `/chat/${id}`,
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        let divApp = '';
        data.chats.forEach( (element) => {
          if (element.sender_id == id) {
            divApp = divApp + `
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">${data.user.name}</span>
                      <span class="direct-chat-timestamp float-right">${element.created_date}</span>
                    </div>
                    <img class="direct-chat-img" src="${data.user.image}" alt="message user image">
                    <div class="direct-chat-text">
                      ${element.message}
                    </div>
                  </div>`;
          } else {
            divApp = divApp + `
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Me</span>
                      <span class="direct-chat-timestamp float-left">${element.created_date}</span>
                    </div>
                    <img class="direct-chat-img" src="${data.me.image}" alt="message user image">
                    <div class="direct-chat-text">
                      ${element.message}
                    </div>
                  </div>`;
          }
        });
        $("#chatModal .direct-chat-messages").append(divApp);
      }
    });
    setTimeout(function() {
                let element = document.getElementById("chatMessagesDiv");
                element.scrollTop = element.scrollHeight;
              }, 200);
  }
</script>

  <script>
    $(document).ready(function() {
      $('#employment').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
      });

      $("#employment").on('click', '.viewMore', function() {
        let employment = $(this).attr('id');
        $.ajax({
          url: `/application/view/${employment}`,
          type: 'GET',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            console.log(data);
            $("#viewModal").modal('show');
            $("#viewModal #full_name").val(data.full_name);
            $("#viewModal #birth_date").val(data.birth_date);
            let sex = '';
            if (data.gender == 1) {
              sex = 'Male';
            } else {
              sex = 'Female';
            }
            $("#viewModal #gender").val(sex);
            $("#viewModal #civil_status").val(data.civil_status);
            $("#viewModal #address").val(data.address);
            $("#viewModal #telephone_number").val(data.telephone_number);
            $("#viewModal #mobile_number").val(data.mobile_number);
            $("#viewModal #email_address").val(data.email_address);
            $("#viewModal #high_school").val(data.high_school);
            $("#viewModal #high_school_year").val(data.high_school_year);
            $("#viewModal #college").val(data.college);
            $("#viewModal #college_year").val(data.college_year);

            $("#viewModal #business_name").val(data.business_name);
            $("#viewModal #business_type").val(data.business_type);
            $("#viewModal #mailing_address").val(data.mailing_address);

            if (data.type == 1) {

              $("#viewModal #regular").css('display', 'block');
              $("#viewModal #request").css('display', 'none');
            } else {

              $("#viewModal #regular").css('display', 'none');
              $("#viewModal #request").css('display', 'block');
            }


            $("#viewModal #title").val(data.title);
            $("#viewModal #details").val(data.details);
            $("#viewModal #offer").val('Php ' + data.min_offer + ' - Php ' + data.max_offer);

            let exp = '';
            if (data.experience == 1) {
              let exp = 'No experience';
            } else if (data.experience == 2) {
              let exp = 'Fresh Graduate';
            }  else if (data.experience == 3) {
              let exp = '1 year';
            }  else if (data.experience == 4) {
              let exp = '2 to 3 years';
            }  else if (data.experience == 5) {
              let exp = '3 to 5 years';
            }  else if (data.experience == 6) {
              let exp = '5 to 10 years';
            } else if (data.experience == 7) {
              let exp = '10 years above';
            }

            $("#viewModal #location").val(data.barangay + ' ' + data.municipality);

            $("#viewModal #request_location").val(data.location);
            $("#viewModal #request_request").val(data.request);
          }
        });
      });
    });
  </script>

</body>
</html>
