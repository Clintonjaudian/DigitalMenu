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
                <h1 class="m-0 text-dark">Lower Right</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard 2</li>
                    <li class="breadcrumb-item active">Lower Right</li>
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
                <h3 class="card-title">Product List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                <div class="float-right">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addLowerRightProductModalBtn">Add Product</button>
                </div>

                <table id="lowerRightDatatable" class="table table-bordered table-striped" width="100%">
                    <thead>
                    <tr>
                    <th>Product Name</th>
                    <th>Classification</th>
                    <th>Add-on 1</th>
                    <th>Add-on 2</th>
                     <th>Status</th>
                    <th>Action</th>
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

{{-- Add New Product For Lower Right Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="addLowerRightProductModalBtn">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">

              <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
              </div>

              <div class="card-body">
                <form method="POST" id="addLowerRightForm" enctype="multipart/form-data"> 
                  @csrf

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="product" class="control-label">Product Name</label>
                      <input id="product" name="product" type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-6">
                      <label for="classification" class="control-label">Classification</label>
                      <input id="classification" name="classification" type="text" class="form-control" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="image_addon1" class="control-label">Select Addon 1 Image</label>
                      <input id="image_addon1" name="image_addon1" type="file" required>
                    </div>

                    <div class="form-group col-6">
                      <label for="image_addon2" class="control-label">Select Addon 2 Image</label>
                      <input id="image_addon2" name="image_addon2" type="file" required>
                    </div>
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="addLowerRightCancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-info btn-sm">Add Product</button>
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

{{-- Edit Product For Lower Right Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="editLowerRightProductModalBtn">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">

              <div class="card-header">
                <h3 class="card-title">Edit Product</h3>
              </div>

              <div class="card-body">
                <form method="POST" id="editLowerRightForm" enctype="multipart/form-data"> 
                  @csrf
                  @method('PUT')
                  
                  <div class="form-group col-12">
                    <label for="edit_product" class="control-label">Product Name</label>
                    <input id="edit_product" name="edit_product" type="text" class="form-control">
                  </div>
                  
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="edit_classification" class="control-label">Classification</label>
                      <input id="edit_classification" name="edit_classification" type="text" class="form-control">
                    </div>

                    <div class="form-group col-6">
                      <label for="edit_status" class="control-label">Status</label>
                      <select name="edit_status" id="edit_status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inctive</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="edit_image_addon1" class="control-label">Select Add-on 1 Image</label>
                      <input id="edit_image_addon1" name="edit_image_addon1" type="file">
                      <input type="hidden" id="hidden_image_addon1" name="hidden_image_addon1">
                      <br>
                      <img src="" id="current_image_addon1" alt="Add-on 1 Image" title="Current Image"  class="img-thumbnail" width="100">
                    </div>
  
                    <div class="form-group col-6">
                      <label for="edit_image_addon2" class="control-label">Select Add-on 2 Image</label>
                      <input id="edit_image_addon2" name="edit_image_addon2" type="file">
                      <input type="hidden" id="hidden_image_addon2" name="hidden_image_addon2">
                      <br>
                      <img src="" id="current_image_addon2" alt="" title="Current Image"  class="img-thumbnail" width="100">
                    </div>
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="editLowerRightCancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-info btn-sm">Submit</button>
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
        $("#lowerRightDatatable").DataTable(
        {
          processing:true,
          serverSide:true,
          ajax:{
            url:"{{route('lower_right.index')}}"
          },
          columns:[
            {
              data:'product_name',
              name:'product_name'
            },
            {
              data:'classification',
              name:'classification'
            },
            {   
              data:'image_addon1',
              render:function(data)
              {
                return '<img src="{{ URL::to("/") }}/assets/images/'+data+'" class="img-thumbnail" width="75" />';
              }
            },
            {   
              data:'image_addon2',
              render:function(data)
              {
                return '<img src="{{ URL::to("/") }}/assets/images/'+data+'" class="img-thumbnail" width="75" />';
              }
            },
            {
              data:'status',
              render:function(data)
              {
                if(data == 1)
                {
                  return '<span class="badge badge-success">Active</span>';
                }

                if(data == 0)
                {
                  return '<span class="badge badge-warning">Inactive</span>';
                }
                }
            },
            {
              data:'action',
              name:'action',
              orderable:false
            }
          ]
        });

        // Parsley Validator
        $("#addLowerRightForm").parsley();

        //Cancel Btn
        $("#addLowerRightCancelBtn").on('click', function()
        {
          $("#addLowerRightForm")[0].reset();
          $("#addLowerRightForm").parsley().reset();
        });

        // Add Lower Right Product
        $("#addLowerRightForm").on('submit', function(event)
          {
            event.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax(
              {
                url:"{{route('lower_right.store')}}",
                method:'post',
                data:formData,
                dataType:'json',
                cache:false,
                processData:false,
                contentType:false,
                async:false,
                success:function(data)
                {
                  if(data.validator)
                  {
                    $("#addLowerRightProductModalBtn").modal('hide');
                    $("#lowerRightDatatable").DataTable().ajax.reload();
                    $("#addLowerRightForm")[0].reset();
                    $("#addLowerRightForm").parsley().reset();
                    swal.fire('Success', 'Successfully Added', 'success');
                  }
                  else
                  {
                    swal.fire('Oops!', 'Error while adding this data.', 'error');
                  }
                }
              });
          });

        // Edit Lower Right Product
        $(document).on('click', '.edit', function()
        {
          var id = $(this).attr('id');

          $.ajax(
            {
              url:'lower_right/'+id+'/edit',
              dataType:'json',
              success:function(data)
              {
                $("#edit_product").val(data.productData.product_name);
                $("#edit_classification").val(data.productData.classification);
                $("#edit_price").val(data.productData.price);
                $("#edit_status").val(data.productData.status);
                $("#hidden_image_addon1").val(data.productData.image_addon1);
                $("#hidden_image_addon2").val(data.productData.image_addon2);
                $("#current_image_addon1").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.image_addon1);
                $("#current_image_addon2").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.image_addon2);

                $("#editLowerRightProductModalBtn").modal('show');

                $("#editLowerRightForm").unbind('submit').bind('submit', function(event)
                {
                  event.preventDefault();
                  var formData = new FormData($(this)[0]);

                  $.ajax(
                    {
                      url:"lower_right/"+id,
                      method:'post',
                      data:formData,
                      dataType:'json',
                      cache:false,
                      contentType:false,
                      processData:false,
                      async:false,
                      success:function(data)
                      {
                        if(data.validator)
                        {
                          $("#editLowerRightProductModalBtn").modal('hide');
                          $("#lowerRightDatatable").DataTable().ajax.reload();
                          $("#editLowerRightForm")[0].reset();
                          swal.fire("Success", 'Successfully Updated', 'success');
                        }
                        else
                        {
                          swal.fire('Oops!', 'Error while updating this data.', 'error');
                        }
                      }
                    });
                });
              }
            });
        });

        // Remove Lower Left Product
        $(document).on('click', '.delete', function()
        {
          var id = $(this).attr('id');

          if(confirm('Are you sure you want to remove this data?'))
          {
            $.ajax(
              {
                url:'lower_right/'+id,
                method:'delete',
                data:{
                  '_token':'{{csrf_token()}}'
                },
                success:function(data)
                {
                  if(data.validator)
                  {
                    $("#lowerRightDatatable").DataTable().ajax.reload();
                    swal.fire('Success', 'Successfully Removed', 'success');
                  }
                  else
                  {
                    swal.fire('Oops!', 'Error while removing this data.', 'error');
                  }
                }
              });
          }
        });
        
      });
     </script>
@endpush