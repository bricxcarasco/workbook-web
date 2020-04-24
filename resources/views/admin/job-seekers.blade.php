<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WorkBook | Seeker</title>

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
    <div id="emptySuccessAlert" class="alertMessage alert alert-warning alert-dismissible fade show" style="display: none;" role="alert">
      Seeker information was empty!
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div id="addSuccessAlert" class="alertMessage alert alert-primary alert-dismissible fade show" style="display: none;" role="alert">
      Seeker information successfully addedd!
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div id="updateSuccessAlert" class="alertMessage alert alert-success alert-dismissible fade show" style="display: none;" role="alert">
      Seeker information successfully updated!
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div id="deleteSuccessAlert" class="alertMessage alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
      Seeker information successfully deleted!
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Job Seekers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Job Seekers</li>
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
                <h3 class="card-title">Job Seeker List</h3>
                {{-- <button class="btn btn-primary float-right" id="add">Add Seeker</button> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example" class="table table-condensed table-hover" width="100%">
                    <thead>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Registration Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                    <tfoot>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Registration Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tfoot>
                  </table>
                </div>
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
            <label>Name</label></br>
              <input type="text"  class="form-control" id ="name_add">
            <label>Birthdate</label></br>
              <input type="date"  class="form-control" id ="birthdate_add">
            <label>Gender</label></br>
              <select class="form-control" id="gender_add">
                <option value="1">Male</option>
                <option value="2">Female</option>
              </select>
            <label>Civil Status</label></br>
              <input type="text"  class="form-control" id ="civil_add">
            <label>Address</label></br>
              <input type="text"  class="form-control" id ="address_add">
            <label>Telephone Number</label></br>
              <input type="text"  class="form-control" id ="telephone_number_add">
            <label>Mobile Number</label></br>
              <input type="text"  class="form-control" id ="mobile_number_add">
            <label>Email Address</label></br>
              <input type="text"  class="form-control" id ="email_address_add">
            <label>High School</label></br>
              <input type="text"  class="form-control" id ="high_school_add">
            <label>Year Graduated</label></br>
              <input type="text"  class="form-control" id ="year_high_school_add">
            <label>College</label></br>
              <input type="text"  class="form-control" id ="college_add">
            <label>Year Graduated</label></br>
              <input type="text"  class="form-control" id ="year_college_add">
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

            <label>Name</label></br>
              <input type="text"  class="form-control" id ="name" required>
            
            <label>Birthdate</label></br>
              <input type="date"  class="form-control" id ="birthdate" required>
            
            <label>Gender</label></br>
              <select class="form-control" id="gender">
                <option value="1">Male</option>
                <option value="2">Female</option>
              </select>
            
            <label>Civil Status</label></br>
              <input type="text"  class="form-control" id ="civil" required>
            
            <label>Address</label></br>
              <input type="text"  class="form-control" id ="address" required>
            
            <label>Telephone Number</label></br>
              <input type="text"  class="form-control" id ="telephone_number">
            
            <label>Mobile Number</label></br>
              <input type="text"  class="form-control" id ="mobile_number" required>
            
            <label>Email Address</label></br>
              <input type="text"  class="form-control" id ="email_address" required>
            
            <label>High School</label></br>
              <input type="text"  class="form-control" id ="high_school">
            
            <label>Year Graduated</label></br>
              <input type="text"  class="form-control" id ="year_high_school">
            
            <label>College</label></br>
              <input type="text"  class="form-control" id ="college">
            
            <label>Year Graduated</label></br>
              <input type="text"  class="form-control" id ="year_college">
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
            <label>Are you sure you want to delete this?</label>
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

        let name = $('#addModal #name_add').val();
        let birthdate = $('#addModal #birthdate_add').val();
        let gender = $('#addModal #gender_add').val();
        let civil = $('#addModal #civil_add').val();
        let address = $('#addModal #address_add').val();
        let telephone_number = $('#addModal #telephone_number_add').val();
        let mobile_number = $('#addModal #mobile_number_add').val();
        let email_address = $('#addModal #email_address_add').val();
        let high_school = $('#addModal #high_school_add').val();
        let year_high_school = $('#addModal #year_high_school_add').val();
        let college = $('#addModal #college_add').val();
        let year_college = $('#addModal #year_college_add').val();

        $.ajax({
          url: '/seeker',
          type: 'POST',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            full_name : name,
            birth_date : birthdate,
            gender : gender,
            civil_status : civil,
            address : address,
            telephone_number : telephone_number,
            mobile_number : mobile_number,
            email_address : email_address,
            high_school : high_school,
            high_school_year : year_high_school,
            college : college,
            college_year : year_college
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

      });

      $('#editModal').on('click', '#save', function() {

        let id = $('#editModal #id').val();
        let name = $('#editModal #name').val();
        let birthdate = $('#editModal #birthdate').val();
        let gender = $('#editModal #gender').val();
        let civil = $('#editModal #civil').val();
        let address = $('#editModal #address').val();
        let telephone_number = $('#editModal #telephone_number').val();
        let mobile_number = $('#editModal #mobile_number').val();
        let email_address = $('#editModal #email_address').val();
        let high_school = $('#editModal #high_school').val();
        let year_high_school = $('#editModal #year_high_school').val();
        let college = $('#editModal #college').val();
        let year_college = $('#editModal #year_college').val();

        $.ajax({
          url: '/seeker/edit',
          type: 'PUT',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            id : id,
            full_name : name,
            birth_date : birthdate,
            gender : gender,
            civil_status : civil,
            address : address,
            telephone_number : telephone_number,
            mobile_number : mobile_number,
            email_address : email_address,
            high_school : high_school,
            high_school_year : year_high_school,
            college : college,
            college_year : year_college
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
            url: `/seeker/delete`,
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

    });

    function view(id) {
      $.ajax({
        url: `/seeker/get/${id}`,
        type: 'GET',
        success: function(data) {
          if (data == 'Empty') {
            $('.alertMessage').hide('slow');
            $('#emptySuccessAlert').show('slow');
          } else {
            $('#viewModal').modal('show');
            $('#viewModal #id2').val(data.id);
            $('#viewModal #name2').val(data.full_name);
            $('#viewModal #birthdate2').val(data.birth_date);
            $('#viewModal #gender2').val(data.gender);
            $('#viewModal #civil2').val(data.civil_status);
            $('#viewModal #address2').val(data.address);
            $('#viewModal #telephone_number2').val(data.telephone_number);
            $('#viewModal #mobile_number2').val(data.mobile_number);
            $('#viewModal #email_address2').val(data.email_address);
            $('#viewModal #high_school2').val(data.high_school);
            $('#viewModal #year_high_school2').val(data.high_school_year);
            $('#viewModal #college2').val(data.college);
            $('#viewModal #year_college2').val(data.college_year);
          }

        }
      });
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

    // function edit(id) {
    //   $.ajax({
    //     url: `/seeker/${id}`,
    //     type: 'GET',
    //     dataType: 'json',
    //     success: function(data) {
    //       $('#editModal').modal('show');
    //       $('#editModal #id').val(data.id);
    //       $('#editModal #name').val(data.full_name);
    //       $('#editModal #birthdate').val(data.birth_date);
    //       $('#editModal #gender').val(data.gender);
    //       $('#editModal #civil').val(data.civil_status);
    //       $('#editModal #address').val(data.address);
    //       $('#editModal #telephone_number').val(data.telephone_number);
    //       $('#editModal #mobile_number').val(data.mobile_number);
    //       $('#editModal #email_address').val(data.email_address);
    //       $('#editModal #high_school').val(data.high_school);
    //       $('#editModal #year_high_school').val(data.high_school_year);
    //       $('#editModal #college').val(data.college);
    //       $('#editModal #year_college').val(data.college_year);
    //     }
    //   });
    // }

    function remove(id) {
      $('#deleteModal').modal('show');
      $('#deleteModal #id').val(id);
    }

    function getList() {
        $.ajax({
          url : "/seeker_list",
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
                    bSortable : false,
                    render : function (data, type, row) {
                      return  `
                            <button class="btn btn-primary" onClick="view(this.id)" id="${data.id}"><i class="fa fa-eye"></i> View</button>
                            <button class="btn btn-success" onClick="chat(this.id)" id="${data.id}"><i class="fa fa-comment"></i> Chat</button>
                            <button class="btn btn-danger" onClick="remove(this.id)" id="${data.id}"><i class="fa fa-times-circle"></i> Delete</button>`;
                    }  
                }
              ]
          });
        });
    }
  </script>
</body>
</html>