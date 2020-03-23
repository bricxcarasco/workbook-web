<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WorkBook | Provider</title>

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
    <div id="enableSuccessAlert" class="alertMessage alert alert-warning alert-dismissible fade show" style="display: none;" role="alert">
      Account successfully enabled!
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div id="emptySuccessAlert" class="alertMessage alert alert-warning alert-dismissible fade show" style="display: none;" role="alert">
      Provider information was empty!
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div id="addSuccessAlert" class="alertMessage alert alert-primary alert-dismissible fade show" style="display: none;" role="alert">
      Provider information successfully addedd!
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div id="updateSuccessAlert" class="alertMessage alert alert-success alert-dismissible fade show" style="display: none;" role="alert">
      Provider information successfully updated!
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div id="deleteSuccessAlert" class="alertMessage alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
      Provider information disabled!
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Job Providers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Job Providers</li>
            </ol>
          </div><!-- /.col -->


        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="col-12">
  
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Job Provider List</h3>
                <button class="btn btn-primary float-right" id="add"><i class="fa fa-plus-circle"></i> Add User</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example" class="table table-condensed table-hover" width="100%">
                  <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th>Status</th>
                    <th>Account Status</th>
                    <th>Action</th>
                  </thead>
                  <tfoot>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th>Status</th>
                    <th>Account Status</th>
                    <th>Action</th>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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


  <!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Seeker</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <label>Business Name</label></br>
              <input type="text"  class="form-control" id ="add_business_name">

            <label>Business Type</label></br>
              <input type="text"  class="form-control" id ="add_business_type">
            
            <label>Birthdate</label></br>
              <input type="date"  class="form-control" id ="add_birth_date">
            
            <label>Gender</label></br>
              <select class="form-control" id ="add_gender">
                <option value="1">Male</option>
                <option value="2">Female</option>
              </select>
            
            <label>Mailing Address</label></br>
              <input type="text"  class="form-control" id ="add_mailing_address">
            
            <label>Mobile Number</label></br>
              <input type="text"  class="form-control" id ="add_mobile_number">
            
            <label>Telephone Number</label></br>
              <input type="text"  class="form-control" id ="add_telephone_number">
            
            <label>Email Address</label></br>
              <input type="text"  class="form-control" id ="add_email_address">
              <span id="spanInvalidEmail" style="color:red; display:none;"><i>Invalid Email Address</i></span>
            
            <label>Profile Description</label></br>
              <input type="text"  class="form-control" id ="add_profile_desc">
            
            <label>Facebook</label></br>
              <input type="text"  class="form-control" id ="add_facebook">
            
            <label>Twitter</label></br>
              <input type="text"  class="form-control" id ="add_twitter">
            
            <label>Instagram</label></br>
              <input type="text"  class="form-control" id ="add_instagram">
            
            <label>Affiliation</label></br>
              <input type="text"  class="form-control" id ="add_affiliation">
            
            <label>DTI Permit</label></br>
              <input type="text"  class="form-control" id ="add_dti_permit">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="addSeeker">Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>ID</label></br>
            <input type="text"  class="form-control" readonly id ="id2">
          <label>Name</label></br>
            <input type="text"  class="form-control" readonly id ="name2">
          <label>Birthdate</label></br>
            <input type="date"  class="form-control" readonly id ="birthdate2">
          <label>Gender</label></br>
            <select class="form-control" id="gender2" readonly>
              <option value="1">Male</option>
              <option value="2">Female</option>
            </select>
          <label>Civil Status</label></br>
            <input type="text"  class="form-control" readonly id ="civil2">
          <label>Address</label></br>
            <input type="text"  class="form-control" readonly id ="address2">
          <label>Telephone Number</label></br>
            <input type="text"  class="form-control" readonly id ="telephone_number2">
          <label>Mobile Number</label></br>
            <input type="text"  class="form-control" readonly id ="mobile_number2">
          <label>Email Address</label></br>
            <input type="text"  class="form-control" readonly id ="email_address2">
          <label>High School</label></br>
            <input type="text"  class="form-control" readonly id ="high_school2">
          <label>Year Graduated</label></br>
            <input type="text"  class="form-control" readonly id ="year_high_school2">
          <label>College</label></br>
            <input type="text"  class="form-control" readonly id ="college2">
          <label>Year Graduated</label></br>
            <input type="text"  class="form-control" readonly id ="year_college2">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

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
            <label>ID</label></br>
              <input type="text" readonly class="form-control" id ="id">

            <label>Business Name</label></br>
              <input type="text"  class="form-control" id ="business_name" required>

            <label>Business Type</label></br>
              <input type="text"  class="form-control" id ="business_type" required>
            
            <label>Birthdate</label></br>
              <input type="date"  class="form-control" id ="birth_date" required>
            
            <label>Gender</label></br>
              <select class="form-control" id="gender">
                <option value="1">Male</option>
                <option value="2">Female</option>
              </select>
            
            <label>Mailing Address</label></br>
              <input type="text"  class="form-control" id ="mailing_address" required>
            
            <label>Mobile Number</label></br>
              <input type="text"  class="form-control" id ="mobile_number" required>
            
            <label>Telephone Number</label></br>
              <input type="text"  class="form-control" id ="telephone_number">
            
            <label>Email Address</label></br>
              <input type="text"  class="form-control" id ="email_address" required>
            
            <label>Profile Description</label></br>
              <input type="text"  class="form-control" id ="profile_desc" required>
            
            <label>Facebook</label></br>
              <input type="text"  class="form-control" id ="facebook">
            
            <label>Twitter</label></br>
              <input type="text"  class="form-control" id ="twitter">
            
            <label>Instagram</label></br>
              <input type="text"  class="form-control" id ="instagram">
            
            <label>Affiliation</label></br>
              <input type="text"  class="form-control" id ="affiliation">
            
            <label>DTI Permit</label></br>
              <input type="text"  class="form-control" id ="dti_permit">
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
          <h5 class="modal-title" id="exampleModalLabel">Disable Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <label>Are you sure you want to disable this account?</label>
            <input type="hidden" id="id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id ="deleteSeeker">Disable</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="enableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enable Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <label>Are you sure you want to enable this account?</label>
            <input type="hidden" id="id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id ="enableAccount">Enable</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>

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


  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  
  


  <script>
    $(document).ready(function() {

      getList();

      $('#add').click(function() {
        $('#addModal').modal('show');
      });

      $('#addModal').on('click', '#addSeeker', function() {

        let add_business_name = $('#addModal #add_business_name').val();
        let add_business_type = $('#addModal #add_business_type').val();
        let add_birth_date = $('#addModal #add_birth_date').val();
        let add_gender = $('#addModal #add_gender').val();
        let add_mailing_address = $('#addModal #add_mailing_address').val();
        let add_mobile_number = $('#addModal #add_mobile_number').val();
        let add_telephone_number = $('#addModal #add_telephone_number').val();
        let add_email_address = $('#addModal #add_email_address').val();
        let add_profile_desc = $('#addModal #add_profile_desc').val();
        let add_facebook = $('#addModal #add_facebook').val();
        let add_twitter = $('#addModal #add_twitter').val();
        let add_instagram = $('#addModal #add_instagram').val();
        let add_affiliation = $('#addModal #add_affiliation').val();
        let add_dti_permit = $('#addModal #add_dti_permit').val();

        if (!add_business_name || !add_business_type || !add_birth_date || !add_gender || !add_mailing_address || !add_email_address || !add_dti_permit || !validateEmail(add_email_address)) {

          if (!add_business_name)
            $("#addModal #add_business_name").css('border-color', 'red');
          else
            $("#addModal #add_business_name").css('border-color', '#ced4da');

          if (!add_business_type)
            $("#addModal #add_business_type").css('border-color', 'red');
          else
            $("#addModal #add_business_type").css('border-color', '#ced4da');

          if (!add_birth_date)
            $("#addModal #add_birth_date").css('border-color', 'red');
          else
            $("#addModal #add_birth_date").css('border-color', '#ced4da');

          if (!add_gender)
            $("#addModal #add_gender").css('border-color', 'red');
          else
            $("#addModal #add_gender").css('border-color', '#ced4da');

          if (!add_mailing_address)
            $("#addModal #add_mailing_address").css('border-color', 'red');
          else
            $("#addModal #add_mailing_address").css('border-color', '#ced4da');

          if (!add_email_address)
            $("#addModal #add_email_address").css('border-color', 'red');
          else
            $("#addModal #add_email_address").css('border-color', '#ced4da');

          if (!add_dti_permit)
            $("#addModal #add_dti_permit").css('border-color', 'red');
          else
            $("#addModal #add_dti_permit").css('border-color', '#ced4da');

          if (!validateEmail(add_email_address))
            $("#addModal #spanInvalidEmail").css('display', 'block');
          else
            $("#addModal #spanInvalidEmail").css('display', 'none');

        } else {
            $.ajax({
              url: '/provider',
              type: 'POST',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                business_name : add_business_name,
                business_type : add_business_type,
                birth_date : add_birth_date,
                gender : add_gender,
                mailing_address : add_mailing_address,
                mobile_number : add_mobile_number,
                telephone_number : add_telephone_number,
                email_address : add_email_address,
                profile_desc : add_profile_desc,
                facebook : add_facebook,
                twitter : add_twitter,
                instagram : add_instagram,
                affiliation : add_affiliation,
                dti_permit : add_dti_permit
              },
              success: function(data) {
                if (data == 'Success') {
                  $('#addModal').modal('hide');
                  $('.alertMessage').hide('slow');
                  $('#addSuccessAlert').show('slow');
                  getList();
                }
              }
            });
        }

      });

      $('#editModal').on('click', '#save', function() {

        let id = $('#editModal #id').val();
        let mailing_address = $('#editModal #mailing_address').val();
        let mobile_number = $('#editModal #mobile_number').val();
        let telephone_number = $('#editModal #telephone_number').val();
        let email_address = $('#editModal #email_address').val();
        let birth_date = $('#editModal #birth_date').val();
        let gender = $('#editModal #gender').val();
        let profile_desc = $('#editModal #profile_desc').val();
        let facebook = $('#editModal #facebook').val();
        let twitter = $('#editModal #twitter').val();
        let instagram = $('#editModal #instagram').val();
        let business_name = $('#editModal #business_name').val();
        let business_type = $('#editModal #business_type').val();
        let affiliation = $('#editModal #affiliation').val();
        let dti_permit = $('#editModal #dti_permit').val();

        $.ajax({
          url: '/provider/edit',
          type: 'PUT',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            id : id,
            mailing_address : mailing_address,
            mobile_number : mobile_number,
            telephone_number : telephone_number,
            email_address : email_address,
            birth_date : birth_date,
            gender : gender,
            profile_desc : profile_desc,
            facebook : facebook,
            twitter : twitter,
            instagram : instagram,
            business_name : business_name,
            business_type : business_type,
            affiliation : affiliation,
            dti_permit : dti_permit
          },
          success: function(data) {
            if (data == 'Success') {
              $('#editModal').modal('hide');
              $('.alertMessage').hide('slow');
              $('#updateSuccessAlert').show('slow');
              getList();
            }
          }
        });

      });

      $('#deleteModal').on('click', '#deleteSeeker', function() {
        let id = $(this).attr('id');
          $.ajax({
            url: `/provider/delete`,
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
                getList();
              }
            }
          });
      });

      $('#chatModal').on('click', '#sendMessage', function() {
        let receiverId = $("#chatModal #receiverId").val();
        let message = $("#chatModal #message").val();
        if (message) {
        // console.log([receiverId, message]);
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

      $('#enableModal').on('click', '#enableAccount', function() {
        let id = $(this).attr('id');
          $.ajax({
            url: `/provider/enable`,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              id: $('#enableModal #id').val()
            },
            success: function(data) {
              if (data == 'Success') {
                $('#enableModal').modal('hide');
                $('.alertMessage').hide('slow');
                $('#enableSuccessAlert').show('slow');
                getList();
              }
            }
          });
      });

    });

    function validateEmail(email) {
      let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }

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

    function edit(id) {
      $.ajax({
        url: `/provider/get/${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          $('#editModal').modal('show');
          $('#editModal #id').val(data.id);
          $('#editModal #mailing_address').val(data.mailing_address);
          $('#editModal #mobile_number').val(data.mobile_number);
          $('#editModal #telephone_number').val(data.telephone_number);
          $('#editModal #email_address').val(data.email_address);
          $('#editModal #birth_date').val(data.birth_date);
          $('#editModal #gender').val(data.gender);
          $('#editModal #profile_desc').val(data.profile_desc);
          $('#editModal #facebook').val(data.facebook);
          $('#editModal #twitter').val(data.twitter);
          $('#editModal #instagram').val(data.instagram);
          $('#editModal #business_name').val(data.business_name);
          $('#editModal #business_type').val(data.business_type);
          $('#editModal #affiliation').val(data.affiliation);
          $('#editModal #dti_permit').val(data.dti_permit);
        }
      });
    }

    function remove(id) {
      $('#deleteModal').modal('show');
      $('#deleteModal #id').val(id);
    }

    function enable(id) {
      $('#enableModal').modal('show');
      $('#enableModal #id').val(id);
    }

    function getList() {
        $.ajax({
          url : "/provider_list",
          method : "GET",
          contentType : 'application/json'
        }).done( function(data) {
          $('#example').dataTable({
              data: data,
              destroy: true,
              columns: [
                  { data : "id" },
                  { data : "name" },
                  { data : "email" },
                  { data : "created_at" },
                  { data : null,
                    render : function (data, type, row) {
                      let badge = "secondary";
                      let status = "idle";
                      if (data.status == 1) {
                        badge = 'success';
                        status = 'online';
                      } else if (data.status == 0) {
                        badge = 'danger';
                        status = 'offline';
                      }
                      return `<span class="badge badge-pill badge-${badge}">${status}</span>`;
                    }
                  },
                  { data : null,
                    render : function (data, type, row) {
                      let badge = "danger";
                      let status = "disabled";
                      if (data.is_delete == 0) {
                        badge = 'success';
                        status = 'activated';
                      }
                      return `<span class="badge badge-pill badge-${badge}">${status}</span>`;
                    }
                  },
                  { data : null, 
                    bSortable : false,
                    render : function (data, type, row) {
                      let verified = `<button class="btn btn-info" onClick="enable(this.id)" id="${data.id}"><i class="fa fa-check-circle"></i> Enable</button>`;
                      if (data.is_delete == 0) {
                        verified = `<button class="btn btn-danger" onClick="remove(this.id)" id="${data.id}"><i class="fa fa-times-circle"></i> Disable</button>`;
                      }
                      return  `
                            <button class="btn btn-primary" onClick="edit(this.id)" id="${data.id}"><i class="fa fa-eye"></i> View</button>
                            <button class="btn btn-success" onClick="chat(this.id)" id="${data.id}"><i class="fa fa-comment"></i> Chat</button>
                            ${verified}`;
                    }  
                }
              ]
          });
        });
    }
  </script>
</body>
</html>