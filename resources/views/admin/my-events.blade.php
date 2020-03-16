@extends('admin.parts.header')

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
  function getCalendarList() {
    $.ajax({
      url: `/calendar/list`,
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        console.log(data);
        var calendar = $('#calendar').fullCalendar({
          editable: false,
          header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
          },
          events: data,
          selectable: true,
          selectHelper: true,
        });
      }
    });
  }

  $(document).ready(function () {
      getCalendarList();
  });
</script>

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
            <h1 class="m-0 text-dark">My Events</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <button class="btn btn-success float-right" id="add">Add Event</button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
        
        <div id="calendar"></div>

      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="listingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <input type="hidden" name="id" id="id">
            <label for="">Target Event</label>
            <select class="form-control" name="target" id="target">
              <option value="1">Custom</option>
              <option value="2">Providers</option>
              <option value="3">Seekers</option>
              <option value="4">All</option>
            </select>

            <label for="">Color</label>
            <input class="form-control" type="color" id="color" name="color" value="#f02bbf">

            <label for="">Start DateTime</label>
            <input class="form-control" type="datetime-local" id="start_date" name="start_date">

            <label for="">End DateTime</label>
            <input class="form-control" type="datetime-local" id="end_date" name="end_date">

            <label for="">Title</label>
            <input class="form-control" type="text" id="title" name="title">

            <span class="spanMessage" style="color:red; display:none;">Make sure fields are not empty!</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id ="updateListing">Save Event</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
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

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<script>
  $(document).ready(function() {
    $("#add").click(function() {
      $("#listingModal").modal("show");
    });

    $("#listingModal").on('click', '#updateListing', function() {
      let target = $("#listingModal #target").val();
      let title = $("#listingModal #title").val();
      let start_date = $("#listingModal #start_date").val();
      let end_date = $("#listingModal #end_date").val();
      let color = $("#listingModal #color").val();
      console.log(color);
      if (!target || !title || !start_date || !end_date || !color) {
        $("#listingModal .spanMessage").css('display', 'block');
      } else {
        $("#listingModal .spanMessage").css('display', 'none');
        $.ajax({
          url: `/calendar/add`,
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            target : target,
            title: title,
            start_date: start_date,
            end_date: end_date,
            end_date: end_date,
            color: color
          },
          success: function(data) {
            if (data == 'Success') { 
              $("#listingModal").modal("hide");
              location.reload();
              alert('Event has been added!');
            } else {
              $("#listingModal").modal("hide");
              location.reload();
              alert('Event adding failed!');
            }
          }
        });
      }
    });
  });
</script>

</body>
</html>
