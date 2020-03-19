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

<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form>
          <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary" style="margin-bottom: 0rem;">
              <div class="card-header">
                <h5 class="card-title">Direct Chat</h5>

                <div class="card-tools">
                  <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
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


<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

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
                      <span class="direct-chat-name float-left">Me</span>
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
                      <span class="direct-chat-name float-right">${data.user.name}</span>
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