@extends('layouts.backend.app')

@push('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Account</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Accounts</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <hr>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Account List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <div class="float-right">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addNewUserModalBtn">Add New User</button>
              </div>

              <table id="accountDatatable" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>NAME</th>
                  <th>EMAIL</th>
                  <th>STATUS</th>
                  <th>ACTION</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

{{-- Add New User Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="addNewUserModalBtn">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">

              <div class="card-header">
                <h3 class="card-title">Add New User</h3>
              </div>

              <div class="card-body">
                <form method="POST" id="userRegistrationForm">
                  @csrf

                  <div class="form-group">
                      <label for="name" class="control-label">Name</label>
                      <input id="name" name="name" type="text" class="form-control" required>

                  </div>

                  <div class="form-group">
                      <label for="email">Email Address</label>
                      <input id="email" name="email" type="email" class="form-control" required>
                  </div>

                  <div class="form-group">
                      <label for="password">Password</label>

                      <input id="password" type="password" class="form-control" name="password" required>
                  </div>

                  <div class="form-group">
                      <label for="password-confirm">Confirm Password</label>

                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required data-parsley-equalto="#password">
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="registrationCancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-info btn-sm">Register</button>
                  </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </section>
      <!-- /.content -->

    </div>
  </div>
</div>

{{-- Edit User Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="editUserModalBtn">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">

              <div class="card-header">
                <h3 class="card-title">Edit User Details</h3>
              </div>

              <div class="card-body">
                <form method="POST" id="editUserForm">
                   @csrf
                   @method('PUT')
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input id="edit_name" name="edit_name" type="text" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="email">Email Address</label>
                      <input id="edit_email" name="edit_email" type="email" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="status">Status</label>
                    <select id="edit_status" name="edit_status" type="text" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="editCancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-info btn-sm">Save</button>
                  </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </section>
      <!-- /.content -->

    </div>
  </div>
</div>

@endsection

@push('js')
<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script>
  $(document).ready(function()
  {

    // Yajra DataTables
    $("#accountDatatable").DataTable(
    {
      processing:true,
      serverSide:true,
      ajax:{
        url:"{{route('account.index')}}",
      },
      columns: [
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'status',
          render:function(data)
          {
            if(data == 1)
            {
              return '<span class="badge badge-success">Active</span>';
            }

            if (data == 0) 
            {
              return '<span class="badge badge-warning">Inactive</span>';
            }
          }
        },
        {
          data: 'action',
          name: 'action',
          orderable:false
        }
      ]
    });

    // Parsley Validator
    $("#userRegistrationForm").parsley();

    // Add User Cancel Btn
    $("#registrationCancelBtn").on('click', function()
    {
     $("#userRegistrationForm")[0].reset();
     $("#userRegistrationForm").parsley().reset();
    });

    // Edit User Cancel Btn
    $("#editCancelBtn").on('click', function()
    {
      $("#editUserForm")[0].reset();
    })

  // Add New User Btn
    $(document).on('submit', '#userRegistrationForm', function(event)
    {
      event.preventDefault();

      $.ajax(
        {
          url:"{{route('account.store')}}",
          method:"post",
          data:$(this).serialize(),
          dataType:'json',
          success:function(data)
          {
            if(data.success)
            {
              $("#addNewUserModalBtn").modal('hide');
              swal("Success", "Successfully Added", 'success');
              $("#userRegistrationForm")[0].reset();
              $("#userRegistrationForm").parsley().reset();
              $("#accountDatatable").DataTable().ajax.reload();
            }
            
            // if (data.messages instanceof Object) 
						// {
						// 	$.each(data.messages, function(index, value)
						// 	{

						// 		var key = $("#" + index);
                
						// 		key.closest('.form-control')
						// 		.removeClass('is-invalid is-valid')
						// 		.addClass(value.length > 0 ? 'is-invalid' : 'is-valid')
						// 		.find('.text-danger').remove();

						// 		key.after(value);
						// 	});
						// }
					}

        });
    });
  // Edit User Btn
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('id');

      $.ajax(
        {
          url:"account/"+id+"/edit",
          dataType:'json',
          success:function(data)
          {
            $("#edit_name").val(data.user_data.name);
            $("#edit_email").val(data.user_data.email);
            $("#edit_status").val(data.user_data.status);

            $("#editUserModalBtn").modal('show');

            $("#editUserForm").on('submit', function(event)
            {
              event.preventDefault();

              $.ajax(
                {
                  url:"account/"+id,
                  method:"post",
                  data:$(this).serialize(),
                  dataType:'json',
                  success:function(data)
                  {
                    if(data.success)
                    {
                      $("#editUserModalBtn").modal('hide');
                      $("#accountDatatable").DataTable().ajax.reload();
                      $("#editUserForm")[0].reset();
                      $("#editUserForm").parsley().reset();
                      swal("Success", "Successfully Updated", 'success');
                    }
                    else
                    {
                      swal("Error", "Error to update this data", "error");
                    }
                  }
                });
            });
          }
        });
    })
  // Remove User Btn
    $(document).on('click', '.delete', function()
    {
      var id = $(this).attr('id');

      if(confirm('Are you sure you want to remove this data?'))
      {
        $.ajax(
          {
            url:"account/"+id,
            method:"delete",
            data:{
              '_token':'{{csrf_token()}}'
            },
            success:function(data)
            {
              if (data.success) 
              {
                $("#accountDatatable").DataTable().ajax.reload();
                swal("Success", "Successfully Deleted", 'success');
              }
              else
              {
                swal("Error", "Error to remove this Data", 'error');
              }
            }
          });
      }
    });
  
  });
</script>
@endpush
