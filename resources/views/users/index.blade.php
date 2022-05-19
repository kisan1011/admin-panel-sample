@extends('layouts.app')
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All user lists</h3>
                <div class="text-right">
                  <a href="javascript:void(0)" onclick="user_modal()" type="button" class="btn btn-primary">Add new user</a>
                  <a href="javascript:void(0)" onclick="reload_data()" type="button" class="btn btn-dark">Refresh</a>
                </div>
              </div>
              <!-- /.card-header -->
              <form id="frm-example" method="post">
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th></th>
                      <th>#</th>
                      <th>First name</th>
                      <th>Last name</th>
                      <!-- <th>Username</th> -->
                      <th>Email</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                  </table>
                  <button type="submit" class="btn btn-danger" id="multiple_delete_btn" disabled>Delete selected <span style="display: none" id="multiple_user_delete_loader"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></button>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Add new users -->
    <div class="modal fade" id="add_edit_user_modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="user_modal_title">Add user</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" name="user_register_form" id="user_register_form">
          <div class="modal-body">
            <div class="container-fluid">
                <input type="hidden" name="id" id="id" value="0">
                <div class="row">
                <div class="form-group col-md-6">
                  <label for="recipient-name" class="col-form-label">First Name: <span class="red">*</span></label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Please enter firstname">
                </div>
                <div class="form-group col-md-6">
                  <label for="recipient-name" class="col-form-label">Last Name: <span class="red">*</span></label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Please enter lastname">
                </div>
                <!-- <div class="form-group col-md-6">
                  <label for="recipient-name" class="col-form-label">Username: <span class="red">*</span></label>
                  <input type="text" class="form-control" id="username" name="username" onkeypress="return Validateusername(event)" placeholder="Please enter username">
                </div> -->
                <div class="form-group col-md-6">
                  <label for="recipient-name" class="col-form-label">Email: <span class="red">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Please enter email">
                </div>
                <div class="form-group col-md-12" id="password_note">
                  <div class="callout callout-info">
                    <h5><i class="icon fas fa-info"></i> Note :</h5>
                    <p>Leave <b>Password</b> and <b>Confirm Password</b> empty, if you are not going to change the password.</p>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="recipient-name" class="col-form-label">Password:  <span class="red" id="password_red">*</span></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Please enter password">
                </div>
                <div class="form-group col-md-6">
                  <label for="recipient-name" class="col-form-label">Confirm Password: <span class="red" id="confirm_password_red">*</span></label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Please enter confirm password">
                </div>
                <div class="form-group col-md-6">
                  <label for="recipient-name" class="col-form-label">Image: <span class="red" id="image_red">*</span></label>
                  <input type="file" name="image" id="image" class="form-control" placeholder="Enter Select Image" onchange="load_preview_image(this);" accept="image/x-png,image/jpg,image/jpeg">
                </div>
                <div class="form-group col-md-6" id="preview_div" style="display: none">
                    <img src="" id="image_preview">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn">Add <span style="display: none" id="loader"><i class="fa fa-spinner fa-spin"></i></span></button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- View user details -->
    <div class="modal fade" id="view_user_modal">
      <div class="modal-dialog modal-mg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" >View user</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                <div class="form-group col-md-12">
                  <label for="recipient-name" class="col-form-label">Name </label>
                  <p id="name">-</p>
                </div>
                <!-- <div class="form-group col-md-12">
                  <label for="recipient-name" class="col-form-label">Username</label>
                  <p id="view_username">-</p>
                </div> -->
                <div class="form-group col-md-12">
                  <label for="recipient-name" class="col-form-label">Email</label>
                  <p id="view_email">-</p>
                </div>
                <div class="form-group col-md-12">
                    <label for="recipient-name" class="col-form-label">Image</label></br>
                    <img src="" id="view_image_preview" class="user_image img-fluid">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready( function () {
      // Get user data
      var table = $('#example1').DataTable({
          processing: true,
          serverSide: true,
          dom: 'Bfrtip',
          buttons: ['excel'],
          ajax: "{{ route('users.index') }}",
          "order":[],
          columnDefs: [
            {
                targets: 0,
                checkboxes: {
                   selectRow: true
                }
            },
            { orderable: false, targets: [0,1,5,6] }
          ],
          select: {
           style: 'multi'
          },
          columns: [
              { data: 'id', name: 'id', searchable: false},
              { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
              { data: 'first_name', name: 'first_name' },
              { data: 'last_name', name: 'last_name' },
              // { data: 'username', name: 'username' },
              { data: 'email', name: 'email' },
              { data: 'image', name: 'image' },
              { data: 'actions', name: 'actions'}
          ],
      });


      // Multiple Delete
      $('#frm-example').on('submit', function(e){
          var rows_selected = table.column(0).checkboxes.selected();
          if(rows_selected.length>0){
            e.preventDefault();
            Swal.fire({
              title: 'Are you sure want to delete multiple rows?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value==true) {
                var selected_rows_array = [];
                $.each(rows_selected, function(index, rowId){
                   selected_rows_array.push(rowId);
                });
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    data: {
                      ids: selected_rows_array,
                    },
                    url: '{{ url("multiple_user_delete")}}',
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    beforeSend: function () {
                      $('#multiple_user_delete_loader').show();
                      $("#multiple_delete_btn").prop('disabled', true);
                    },
                    success: function (response)
                    {
                      $('#multiple_user_delete_loader').hide();
                      if(response.status){
                          table.columns().checkboxes.deselect(true);
                          toastr.success(response.message);
                          $('#example1').DataTable().ajax.reload();
                      } else {
                          toastr.error(response.message);
                      }
                    },
                    error: function ()
                    {
                      $('#multiple_user_delete_loader').hide();
                      $("#multiple_delete_btn").prop('disabled', false);
                      toastr.error('Please Reload Page.');
                    }
                });
              } else {
                return false;
              }
            });
          } else {
            toastr.error('Please select atleast any one row');
            e.preventDefault();
          }
      });
    });

    // Add user modal open
    function user_modal(){
      var $alertas = $('#user_register_form');
      $alertas.validate().resetForm();
      $alertas.find('.error').removeClass('error');
      $('#user_register_form')[0].reset();
      $("#add_edit_user_modal").modal('show');
      $("#id").val(0);
      $("#user_modal_title").text('Add user');
      $("#preview_div").hide();
      $('#btn').html('Add <span style="display: none" id="loader"><i class="fa fa-spinner fa-spin"></i></span>');
      $("#password_note,#password_note1").hide();
      $("#confirm_password_red,#password_red,#image_red").show();
    }

    // Add or Edit user details
    var myForm = document.getElementById('user_register_form');
    var formData = new FormData(myForm);
    $("#user_register_form").validate({
        rules: {
           first_name: {
              required: true,
              lettersonly: true
           },
           last_name: {
              required: true,
              lettersonly: true
           },
           email: {
              required: true,
              email:true,
              remote: {
                  url: "{{ url('check_email_dublicate') }}",
                  type: "get",
                  data: { id: function() { return $( "#id" ).val(); } }
              }
           },
           // username: {
           //    required: true,
           //    remote: {
           //        url: "{{ url('check_username_dublicate') }}",
           //        type: "get",
           //        data: { id: function() { return $( "#id" ).val(); } }
           //    }
           // },
           password: {
              required: {
                  depends:function(){
                    var id = $('#id').val();
                      if(id==0 || id=='') {
                          return true;
                      } else {
                          return false;
                      }
                  }
              },
              minlength: 8,
          },
          confirm_password: {
              required: {
                  depends:function(){
                    var id = $('#id').val();
                      if(id==0 || id=='') {
                          return true;
                      } else {
                          return false;
                      }
                  }
              },
              equalTo: "#password"
          },
          image:{
            required:{
              depends:function(){
                var id = $('#id').val();
                  if(id==0 || id=='') {
                      return true;
                  } else {
                      return false;
                  }
              }
            },
            accept: "image/jpg,image/jpeg,image/png"
          },
        },
        messages: {
           first_name:{
              required : "Please enter firstname",
              lettersonly : "Please enter valid name"
           },
           last_name:{
              required : "Please enter lastname",
              lettersonly : "Please enter valid name"
           },
           // username: {
           //    required : "Please enter username",
           //    remote: "Username already taken!"
           // },
           email: {
              required : "Please enter email",
              remote: "Email already taken!"
           },
           password: {
              required : "Please enter password",
              minlength: "Please enter password atleast 8 character!"
           },
           confirm_password: {
              required : "Please enter confirm password"
           },
           image: {
              required: 'Please select image!',
              accept: 'Please select only image!'
           },
        },
        submitHandler: function(form,e) {
           e.preventDefault();
           $.ajax({
              url: "{{ route('users.store') }}",
              type: "POST",
              data: new FormData(myForm),
              dataType: 'json',
              processData: false,
              contentType: false,
              headers: {'X-CSRF-TOKEN': csrf_token},
              beforeSend: function () {
                  $('#building').show();
                  $('#btn').prop('disabled', true);
              },
              success: function(result)
              {
                  $('#btn').prop('disabled', false);
                  if (result.status) {
                      $('#example1').DataTable().ajax.reload();
                      $("#add_edit_user_modal").modal('hide');
                      $("#user_register_form")[0].reset();
                      toastr.success(result.message);
                  } else {
                      toastr.error(result.message);
                  }
                  $('#building').hide();
              },
              error: function () {
                  toastr.error('Please Reload Page.');
                  $('#building').hide();
                  $('#btn').prop('disabled', false);
              }
          });
          return false;
        }
      });
    // Edit user modal open
    function edit_user_modal(id){
      var $alertas = $('#user_register_form');
      $alertas.validate().resetForm();
      $("#confirm_password_red,#password_red,#image_red").hide();
      $alertas.find('.error').removeClass('error');

      $.ajax({
          type: 'GET',
          data: {
            id: id,
            _method: 'SHOW'
          },
          url: '{{ url("users")}}'+'/'+id,
          headers: {'X-CSRF-TOKEN': csrf_token},
          beforeSend: function () {
              $('#building').show();
          },
          success: function (response)
          {
            if(response.status){
                $("#password_note,#password_note1").show();
                $("#user_modal_title").text('Edit user');
                $("#id").val(response.data.id);
                $("#first_name").val(response.data.first_name);
                $("#last_name").val(response.data.last_name);
                $("#email").val(response.data.email);
                // $("#username").val(response.data.username);
                $('#btn').html('Update <span style="display: none" id="loader"><i class="fa fa-spinner fa-spin"></i></span>');
                $("#image_preview").attr("src", response.data.image);
                $("#preview_div").show();
                $("#add_edit_user_modal").modal('show');
            } else {
                toastr.error(response.message);
            }
            $('#building').hide();
          },
          error: function ()
          {
            $('#building').hide();
            toastr.error('Please Reload Page.');
          }
      });
    }

    // View user modal open
    function view_user_modal(id){

      $.ajax({
          type: 'GET',
          data: {
            id: id,
            _method: 'SHOW'
          },
          url: '{{ url("users")}}'+'/'+id,
          headers: {'X-CSRF-TOKEN': csrf_token},
          beforeSend: function () {
              $('#building').show();
          },
          success: function (response)
          {
            if(response.status){
                $("#name").text(response.data.first_name+' '+response.data.last_name);
                $("#view_email").text(response.data.email);
                // $("#view_username").text(response.data.username);
                $("#view_image_preview").attr("src", response.data.image);
            } else {
                toastr.error(response.message);
            }
            $('#building').hide();
            $("#view_user_modal").modal('show');
          },
          error: function ()
          {
            toastr.error('Please Reload Page.');
            $('#building').hide();
          }
      });
    }

    // Delete record
    function DeleteData(id)
    {
      Swal.fire({
        title: 'Are you sure want to delete these record?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value==true) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                  id: id,
                  _method: 'DELETE'
                },
                url: '{{ url("users")}}'+'/'+id,
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': csrf_token},
                beforeSend: function () {
                    $('#building').show();
                },
                success: function (response)
                {
                  if (response.status) {
                    toastr.success(response.message);
                    $('#example1').DataTable().ajax.reload();
                  } else {
                    toastr.error(response.message);
                  }
                  $('#building').hide();
                },
                error: function () {
                  toastr.error('Please Reload Page.');
                  $('#building').hide();
                }
            });
        }
      })
    }
</script>
@endpush
