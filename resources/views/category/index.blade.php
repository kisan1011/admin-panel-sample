@extends('layouts.app')
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All category lists</h3>
                <div class="text-right">
                  <a href="javascript:void(0)" onclick="category_modal()" type="button" class="btn btn-primary">Add new category</a>
                  <a href="javascript:void(0)" onclick="reload_data()" type="button" class="btn btn-dark">Refresh</a>
                  <a href="javascript:void(0)" onclick="import_excel()" type="button" class="btn btn-info">Import Excel</a>
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
                      <th>Category</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                  </table>
                  <button type="submit"  class="btn btn-danger" id="multiple_delete_btn" disabled>Delete selected <span style="display: none" id="multiple_delete_loader"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span></button>
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

    <!-- Add category -->
    <div class="modal fade" id="add_edit_category_modal">
      <div class="modal-dialog modal-mg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modal_title">Add category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" name="category_form" id="category_form">
          <div class="modal-body">
            <div class="container-fluid">
                <input type="hidden" name="id" id="id" value="0">
                <div class="row">
                <div class="form-group col-md-12">
                  <label class="col-form-label">Category: <span class="red">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Please enter category">
                </div>
                <div class="form-group col-md-12">
                  <label class="col-form-label">Image:</label>
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

    <!-- View category details -->
    <div class="modal fade" id="view_user_modal">
      <div class="modal-dialog modal-mg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" >View category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                <div class="form-group col-md-12">
                  <label for="recipient-name" class="col-form-label">Name </label>
                  <p id="view_name">-</p>
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

    <!-- Import export -->
    <div class="modal fade" id="import_excel">
      <div class="modal-dialog modal-mg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="user_modal_title">Import excel</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" name="import_excel_form" id="import_excel_form">
          <div class="modal-body">
            <div class="container-fluid">
              <input type="hidden" name="id" id="id" value="0">
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="recipient-name" class="col-form-label">Image: <span class="red" id="image_red">*</span></label>
                  <input type="file" name="file" id="file" class="form-control" placeholder="Enter Select File">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="import_btn">Add <span style="display: none" id="import_loader"><i class="fa fa-spinner fa-spin"></i></span></button>
          </div>
          </form>
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
          paging: true,
          bFilter: false,
          className: 'select-checkbox',
          ordering: true,
          searching: true,
          ajax: "{{ route('category.index') }}",
          "order":[],
          columnDefs: [
          {
              targets: 0,
              checkboxes: {
                 selectRow: true
              }
          },
          // {targets: [ 0 ],visible: false},
          { orderable: false, targets: [0,1,3,4] }
          ],
          select: {
           style: 'multi'
          },
            columns: [
              { data: 'id', name: 'id', searchable: false},
              { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
              { data: 'name', name: 'name' },
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
                    url: '{{ url("multiple_category_delete")}}',
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    beforeSend: function () {
                      $('#building').show();
                      $("#multiple_delete_btn").prop('disabled', true);
                    },
                    success: function (response)
                    {
                      $('#building').hide();
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
                      $('#building').hide();
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
    function category_modal(){
      var $alertas = $('#category_form');
      $alertas.validate().resetForm();
      $alertas.find('.error').removeClass('error');
      $('#category_form')[0].reset();
      $("#add_edit_category_modal").modal('show');
      $("#id").val(0);
      $("#modal_title").text('Add category');
      $("#preview_div").hide();
      $('#btn').html('Add <span style="display: none" id="loader"><i class="fa fa-spinner fa-spin"></i></span>');
    }

    // Add or Edit user details
    var myForm = document.getElementById('category_form');
    var formData = new FormData(myForm);
    $("#category_form").validate({
      rules: {
         name: {
            required: true,
            remote: {
                url: "{{ url('check_category_name_dublicate') }}",
                type: "get",
                data: { id: function() { return $("#id").val(); } }
            }
         },
        image:{
          accept: "image/jpg,image/jpeg,image/png"
        },
      },
      messages: {
         name:{
            required : "Please enter category name",
            remote : "Category already taken",
         },
         image: {
            accept: 'Please select only image!'
         },
      },
      submitHandler: function(form,e) {
         e.preventDefault();
         var myForm = document.getElementById('category_form');
         var formData = new FormData(myForm);
         $.ajax({
            url: "{{ route('category.store') }}",
            type: "POST",
            data: formData,
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
                $('#building').hide();
                $('#btn').prop('disabled', false);
                if (result.status) {
                    $('#example1').DataTable().ajax.reload();
                    $("#category_form")[0].reset();
                    $("#add_edit_category_modal").modal('hide');
                    toastr.success(result.message);
                } else {
                    toastr.error(result.message);
                }
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
    function edit_category_modal(id){
      var $alertas = $('#category_form');
      $alertas.validate().resetForm();
      $alertas.find('.error').removeClass('error');

      $.ajax({
          type: 'GET',
          data: {
            id: id,
            _method: 'SHOW'
          },
          url: '{{ url("category")}}'+'/'+id,
          headers: {'X-CSRF-TOKEN': csrf_token},
          beforeSend: function () {
              $('#building').show();
          },
          success: function (response)
          {
            if(response.status){
                $("#modal_title").text('Edit category');
                $("#id").val(response.data.id);
                $("#name").val(response.data.name);
                $('#btn').html('Update <span style="display: none" id="loader"><i class="fa fa-spinner fa-spin"></i></span>');
                $("#image_preview").attr("src", response.data.image);
                $("#preview_div").show();
                $('#building').hide();
                $("#add_edit_category_modal").modal('show');
            } else {
                toastr.error(response.message);
                $('#building').hide();
            }
          },
          error: function ()
          {
            toastr.error('Please Reload Page.');
          }
      });
    }

    // View user modal open
    function view_category_modal(id){

      $.ajax({
          type: 'GET',
          data: {
            id: id,
            _method: 'SHOW'
          },
          url: '{{ url("category")}}'+'/'+id,
          headers: {'X-CSRF-TOKEN': csrf_token},
          beforeSend: function () {
              $('#building').show();
          },
          success: function (response)
          {
            if(response.status){
                $("#view_name").text(response.data.name);
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
                url: '{{ url("category")}}'+'/'+id,
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

    // import excel modal open
    function import_excel(){
      var $alertas = $('#import_excel_form');
      $alertas.validate().resetForm();
      $alertas.find('.error').removeClass('error');
      $("#import_excel").modal('show');
    }

    // Add or Edit user details
    var myForm = document.getElementById('import_excel_form');
    var formData = new FormData(myForm);
    $("#import_excel_form").validate({
      rules: {
        file:{
          required: true,
          extension: "xlsx|xls"
        },
      },
      messages: {
         file: {
            required: 'Please select excel file',
            extension: 'Please select only excel file!'
         },
      },
      submitHandler: function(form,e) {
         e.preventDefault();
         $.ajax({
            url: "{{ url('import') }}",
            type: "POST",
            data: new FormData(myForm),
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': csrf_token},
            beforeSend: function () {
                $('#building').show();
                $('#import_btn').prop('disabled', true);
            },
            success: function(result)
            {
                $('#import_btn').prop('disabled', false);
                if (result.status) {
                    $('#example1').DataTable().ajax.reload();
                    $("#import_excel_form")[0].reset();
                    $("#import_excel").modal('hide');
                    toastr.success(result.message);
                } else {
                    toastr.error(result.message);
                }
                $('#building').hide();
            },
            error: function () {
                toastr.error('Please Reload Page.');
                $('#building').hide();
                $('#import_btn').prop('disabled', false);
            }
        });
        return false;
      }
    });
</script>
@endpush
