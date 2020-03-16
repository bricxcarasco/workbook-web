<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WorkBook | User Activity</title>

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

  @include('admin.parts.navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Activity</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">User Activity</li>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $data_count['jobs'] }}</h3>

                <p>Jobs</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="/admin/manage-listings" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $data_count['providers'] }}<sup style="font-size: 20px"></sup></h3>

                <p>Providers</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="/admin/job-providers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $data_count['seekers'] }}</h3>

                <p>Job Seekers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/admin/job-seekers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $data_count['users'] }}</h3>

                <p>All Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="/admin/user-activity" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">WorkBook Users Activity</h3>
              <a href="javascript:void(0);">View Report</a>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">{{ $data_count['users'] }}</span>
                <span>Total Usage Count</span>
              </p>
              <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 12.5%
                </span>
                <span class="text-muted">Since last week</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="visitors-chart" height="200"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i> This Week
              </span>

              <span>
                <i class="fas fa-square text-gray"></i> Last Week
              </span>
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


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

  <script>

      $(document).ready(function () {
        'use strict'

        var ticksStyle = {
          fontColor: '#495057',
          fontStyle: 'bold'
        }

        var mode      = 'index'
        var intersect = true

        var $visitorsChart = $('#visitors-chart')
        var visitorsChart  = new Chart($visitorsChart, {
          data   : {
            labels  : {!! json_encode($all_dates) !!},
            datasets: [{
              label               : 'Providers',
              type                : 'line',
              data                : {!! json_encode($providers) !!},
              backgroundColor     : 'transparent',
              borderColor         : '#28a745',
              pointBorderColor    : '#28a745',
              pointBackgroundColor: '#28a745',
              fill                : false,
              pointHoverBackgroundColor: '#28a745',
              pointHoverBorderColor    : '#28a745'
            },
            {
              label               : 'Seekers',
              type                : 'line',
              data                : {!! json_encode($seekers) !!},
              backgroundColor     : 'tansparent',
              borderColor         : '#16a2b8',
              pointBorderColor    : '#16a2b8',
              pointBackgroundColor: '#16a2b8',
              fill                : false,
              pointHoverBackgroundColor: '#16a2b8',
              pointHoverBorderColor    : '#16a2b8'
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
              display: true
            },
            scales             : {
              yAxes: [{
                display: true,
                gridLines: {
                  display      : true,
                  lineWidth    : '4px',
                  color        : '#ffc107',
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
                  display: true
                },
                ticks    : ticksStyle
              }]
            }
          }
        })
      });

  </script>

</body>
</html>
