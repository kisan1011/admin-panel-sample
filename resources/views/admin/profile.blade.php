@extends('layouts.app')
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
              </div>
              <form id="profile_frm" name="profile_frm" method="post">
              <div class="card-body">
                  <input type="hidden" id="id" name="id" value="{{$user->id}}">
                  <div class="row">
                    <div class="form-group col-md-12" id="password_note"> 
                      <div class="callout callout-info">
                        <h5><i class="icon fas fa-info"></i> Note :</h5>
                        <p>Leave <b>Password</b> and <b>Confirm Password</b> empty, if you are not going to change the password.</p>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Firstname <span class="red">*</span></label>
                        <input type="text" class="form-control" placeholder="Please enter firstname" id="first_name" name="first_name" value="{{$user->first_name}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Lastname <span class="red">*</span></label>
                        <input type="text" class="form-control" placeholder="Please enter lastname" id="last_name" name="last_name" value="{{$user->last_name}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Username <span class="red">*</span></label>
                        <input type="text" class="form-control" onkeypress="return Validateusername(event)" placeholder="Please enter username" id="username" name="username" value="{{$user->username}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Email <span class="red">*</span></label>
                        <input type="text" class="form-control" placeholder="Please enter email" id="email" name="email" value="{{$user->email}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Please enter password" id="password" name="password">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Please enter confirm password" id="confirm_password" name="confirm_password">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" id="image" class="form-control" placeholder="Enter Select Image" onchange="load_preview_image(this);" accept="image/x-png,image/jpg,image/jpeg">
                      </div>
                    </div>
                    
                  </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right" id="btn">Edit <span style="display: none" id="loader"><i class="fa fa-spinner fa-spin"></i></span></button>
              </div>
              </form>
              <!-- /.card-body -->
            </div>
        </div>
      </div>
    </section>
@endsection
@push('js')
<script>

  // Add or Edit user details
  var myForm = document.getElementById('profile_frm');
  var formData = new FormData(myForm);
  $("#profile_frm").validate({
    rules: {
       first_name: {
          required: true,
          lettersonly: true
       },
       last_name: {
          required: true,
          lettersonly: true
       },
       username: {
          required: true,
          remote: {
              url: "{{ url('check_username_dublicate') }}",
              type: "get",
              data: { id: function() { return $( "#id" ).val(); } }
          }
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
       password: {
          minlength: 8,
       },
       confirm_password: {
          equalTo: "#password"
       },
       image:{
          accept: "image/jpg,image/jpeg,image/png"
      },
    }, 
    messages: {
       first_name:{
          required : "Please enter firstname",
          lettersonly : "Please enter valid firstname"
       },
       last_name:{
          required : "Please enter lastname",
          lettersonly : "Please enter valid lastname"
       },
       username: {
          required : "Please enter username",
          remote: "Username already taken!"
       },
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
          accept: 'Only allow image!'
       },
    },
    submitHandler: function(form,e) {
       e.preventDefault();
       $.ajax({
          url: "{{ url('update_admin_profile') }}",
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
                  $("#password,#confirm_password").val('');
                  toastr.success(result.message);
                  // $("#image_preview").hide();
                  // $(".admin_profile").attr("src", result.data);
              } else {
                  toastr.error(result.message);
              }
              $('#building').hide();
          },
          error: function () {
              toastr.error('Please Reload Page.');
              $('#loader').hide();
              $('#btn').prop('disabled', false);
              $('#building').hide();
          }
      });
      return false;
    }
  });
</script>
@endpush