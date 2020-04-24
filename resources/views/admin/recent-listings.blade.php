<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WorkBook | Recent Listings</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
            <h1 class="m-0 text-dark">Recent Listings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Recent Listings</li>
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
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Recent Listings Line Chart</h3>
                </div>
              </div>
              <div class="card-body">

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="300"></canvas>
                </div>

              </div>
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Recent Listings Bar Graph</h3>
                </div>
              </div>
              <div class="card-body">

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="300"></canvas>
                </div>

              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Recent Listings</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <div class="table-responsive">

                  <table id="employment" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($category_list as $category)
                      <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td><button id="{{ $category->id }}" class="btn btn-info viewMore">View More</button></td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>ID</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Created At</th>
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Job Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 0rem;">
          
          <table class="table table-striped" id="tabView">
            <thead>
              <tr>
                <th scope="col">Provider</th>
                <th scope="col">Title</th>
                <th scope="col">Details</th>
                <th scope="col">Location</th>
                <th scope="col">Event Date</th>
              </tr>
            </thead>
            <tbody>

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
                      <img class="direct-chat-img" src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="message user image">
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
                      <img class="direct-chat-img" src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="message user image">
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

  <script type="text/javascript">
      $(function () {
        'use strict'

          var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
          }

          var mode      = 'index'
          var intersect = true

          var $salesChart = $('#sales-chart')
          var salesChart  = new Chart($salesChart, {
            type   : 'bar',
            data   : {
              labels  : {!! json_encode($categories) !!},
              datasets: [
                {
                  backgroundColor: '#e83e8c',
                  borderColor    : '#bb0558',
                  data           : {!! json_encode($counts) !!}
                }
              ]
            },
            options: {
              maintainAspectRatio: false,
              tooltips           : {
                mode     : mode,
                intersect: intersect
              },
              hover              : {
                mode     : mode,
                intersect: intersect
              },
              legend             : {
                display: false
              },
              scales             : {
                yAxes: [{
                  // display: false,
                  gridLines: {
                    display      : true,
                    lineWidth    : '4px',
                    color        : 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                  },
                  ticks    : $.extend({
                    beginAtZero: true,
                    suggestedMax: {!! json_encode($total) !!},
                    // Include a dollar sign in the ticks
                    callback: function (value, index, values) {
                      if (value >= 1000) {
                        value /= 1000
                        value += 'k'
                      }
                      return '$' + value
                    }
                  }, ticksStyle)
                }],
                xAxes: [{
                  display  : true,
                  gridLines: {
                    display: false
                  },
                  ticks    : ticksStyle
                }]
              }
            }
          })

          var $visitorsChart = $('#visitors-chart')
          var visitorsChart  = new Chart($visitorsChart, {
            data   : {
              labels  : {!! json_encode($categories) !!},
              datasets: [{
                type                : 'line',
                data                : {!! json_encode($counts) !!},
                backgroundColor     : 'transparent',
                borderColor         : '#007bff',
                pointBorderColor    : '#007bff',
                pointBackgroundColor: '#007bff',
                fill                : false
                // pointHoverBackgroundColor: '#007bff',
                // pointHoverBorderColor    : '#007bff'
              }]
            },
            options: {
              maintainAspectRatio: false,
              tooltips           : {
                mode     : mode,
                intersect: intersect
              },
              hover              : {
                mode     : mode,
                intersect: intersect
              },
              legend             : {
                display: false
              },
              scales             : {
                yAxes: [{
                  // display: false,
                  gridLines: {
                    display      : true,
                    lineWidth    : '4px',
                    color        : 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                  },
                  ticks    : $.extend({
                    beginAtZero : true,
                    suggestedMax: {!! json_encode($total) !!}
                  }, ticksStyle)
                }],
                xAxes: [{
                  display  : true,
                  gridLines: {
                    display: false
                  },
                  ticks    : ticksStyle
                }]
              }
            }
          })
        })


  </script>

  <script>
    $(document).ready(function() {
      $('#employment').DataTable();

      $("#employment").on('click', '.viewMore', function() {
        let id = $(this).attr('id');
        $.ajax({
          url: `/admin/recent-listings/${id}`,
          type: 'GET',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            console.log(data);
            if(data === undefined || data.length == 0) {
              alert('Empty records.');
            } else {
              $("#viewModal").modal('show');
              $("#tabView tbody").html("");
              $.each(data, function(i, e) {
                let str = strip_html_tags(e.details);
                if(str.length > 10) 
                  str = str.substring(0,10);
                  var $tr = $("<tr>").append(
                      $("<td>").text(e.user),
                      $("<td>").text(e.title),
                      $("<td>").text(str+'...'),
                      $("<td>").text(e.location),
                        $("<td>").text(e.created_date)
                  );
                  $tr.appendTo("#tabView tbody");
              });
            }
          }
        });
      });
    });
    function strip_html_tags(str)
    {
       if ((str===null) || (str===''))
           return false;
      else
       str = str.toString();
      return str.replace(/<[^>]*>/g, '');
    }
  </script>



</body>
</html>
