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
                <h1 class="m-0 text-dark">Upper Side</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Upper Side</li>
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
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addDashboard2ProductModalBtn">Add Product</button>
                </div>

                <table id="dashboard2Datatable" class="table table-bordered table-striped" width="100%">
                    <thead>
                    <tr>
                    <th>Product Name</th>
                    <th>Food Image</th>
                    <th>Upper Price Tag</th>
                    <th>Lower Left Price Tag</th>
                    <th>Lower Inner Price Tag</th>
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


{{-- Add New Product For Template2 Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="addDashboard2ProductModalBtn">
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
                <form method="POST" id="addDashboard2Form" enctype="multipart/form-data"> 
                  @csrf

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="product" class="control-label">Product Name</label>
                      <input id="product" name="product" type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-6">
                      <label for="food_image" class="control-label">Select Food Image</label>
                      <input id="food_image" name="food_image" type="file" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="original_price" class="control-label">Select Upper Price Tag</label>
                      <input id="original_price" name="original_price" type="file" required>
                    </div>

                    <div class="form-group col-6">
                      <label for="dou_price" class="control-label">Select Lower Left Price Tag</label>
                      <input id="dou_price" name="dou_price" type="file" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="trio_price" class="control-label">Select Lower Inner Price Tag</label>
                      <input id="trio_price" name="trio_price" type="file" required>
                    </div>
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="addDashboard2CancelBtn">Cancel</button>
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

{{-- Edit Product For Template2 Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="editDashboard2ProductModalBtn">
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
                <form method="POST" id="editDashboard2Form" enctype="multipart/form-data"> 
                  @csrf
                  @method('PUT')
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="edit_product" class="control-label">Edit Product Name</label>
                      <input id="edit_product" name="edit_product" type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-6">
                      <label for="edit_status" class="control-label">Edit Status</label>
                      <select id="edit_status" name="edit_status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="edit_food_image" class="control-label">Edit Food Image</label>
                      <br>
                      <input id="edit_food_image" name="edit_food_image" type="file">
                      <br>
                      <img src="" alt="Food Image" title="Current Food Image" id="current_food_image" class="img-thumbnail" width="100">
                      <input type="hidden" name="hidden_food_image" id="hidden_food_image">
                    </div>

                    <div class="form-group col-6">
                      <label for="edit_original_price" class="control-label">Edit Upper Price Tag</label>
                      <br>
                      <input id="edit_original_price" name="edit_original_price" type="file">
                      <br>
                      <img src="" alt="Original Price" title="Original Price" id="current_original_price" class="img-thumbnail" width="100">
                      <input type="hidden" name="hidden_original_price" id="hidden_original_price">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="edit_dou_price" class="control-label">Edit Lower Left Price Tag</label>
                      <br>
                      <input id="edit_dou_price" name="edit_dou_price" type="file">
                      <br>
                      <img src="" alt="Dou Price" title="Dou Price" id="current_dou_price" class="img-thumbnail" width="100">
                      <input type="hidden" name="hidden_dou_price" id="hidden_dou_price">
                    </div>

                    <div class="form-group col-6">
                      <label for="edit_trio_price" class="control-label">Edit Lower Inner Price Tag</label>
                      <br>
                      <input id="edit_trio_price" name="edit_trio_price" type="file">
                      <br>
                      <img src="" alt="Trio Price" title="Trio Price" id="current_trio_price" class="img-thumbnail" width="100">
                      <input type="hidden" name="hidden_trio_price" id="hidden_trio_price">
                    </div>
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="editDashboard2CancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-info btn-sm">Update</button>
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
      // Yajra DataTable
        $("#dashboard2Datatable").DataTable(
        {
            processing:true,
            serverSide:true,
            ajax:{
                url:"{{route('upper.index')}}"
            },
            columns:[
                {
                  data:'product',
                  name:'product',
                },
                {   
                  data:'food_image',
                  render:function(data)
                  {
                    return '<img src="{{ URL::to("/") }}/assets/images/'+data+'" class="img-thumbnail" width="75" />';
                  }
                },
                {   
                  data:'original_price',
                  render:function(data)
                  {
                    return '<img src="{{ URL::to("/") }}/assets/images/'+data+'" class="img-thumbnail" width="75" />';
                  }
                },
                {   
                  data:'dou_price',
                  render:function(data)
                  {
                    return '<img src="{{ URL::to("/") }}/assets/images/'+data+'" class="img-thumbnail" width="75" />';
                  }
                },
                {   
                  data:'trio_price',
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
        $("#addDashboard2Form").parsley();

        // Cancel Btn when adding product
        $("#addDashboard2CancelBtn").on('click', function()
        {
          $("#addDashboard2Form").parsley().reset();
          $("#addDashboard2Form")[0].reset();
        });

      // Add Product
      $("#addDashboard2Form").on('submit', function(event)
      {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
      
        $.ajax(
          {
            url:"{{route('upper.store')}}",
            method:'post',
            data:formData,
            dataType:'json',
            cache:false,
            processData:false,
            contentType:false,
            async:false,
            success:function(data)
            {
              if(data.exist)
              {
                alert('This product is already exist!');
              }
              else
              {
                if(data.success)
                {
                  $("#addDashboard2ProductModalBtn").modal('hide');
                  $("#addDashboard2Form")[0].reset();
                  $('#addDashboard2Form').parsley().reset();
                  $("#dashboard2Datatable").DataTable().ajax.reload();
                  swal.fire('Success', 'Successfully Added', 'success');
                }
                else
                {
                  swal.fire('Oops!', 'Error while adding this data', 'error');
                }
              }
            }
          });
      });

      // Edit Product
      $(document).on('click', '.edit', function()
      {
        var id = $(this).attr('id');


        $.ajax(
          {
            url:"upper/"+id+"/edit",
            dataType:'json',
            success:function(data)
            {
              $("#edit_product").val(data.productData.product);
              $("#edit_status").val(data.productData.status);
              $("#hidden_food_image").val(data.productData.food_image);
              $("#current_food_image").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.food_image);
              $("#hidden_original_price").val(data.productData.original_price);
              $("#current_original_price").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.original_price);
              $("#hidden_dou_price").val(data.productData.dou_price);
              $("#current_dou_price").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.dou_price);
              $("#hidden_trio_price").val(data.productData.trio_price);
              $("#current_trio_price").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.trio_price);

              $("#editDashboard2ProductModalBtn").modal('show');

              // Submation of edited data
              $("#editDashboard2Form").unbind('submit').bind('submit', function(event)
              {
                event.preventDefault();
                var formData = new FormData($(this)[0]);

                $.ajax(
                  {
                    url:"upper/"+id,
                    method:'post',
                    data:formData,
                    dataType:'json',
                    cache:false,
                    processData:false,
                    contentType:false,
                    async:false,
                    success:function(data)
                    {
                      if(data.success)
                      {
                        $("#editDashboard2ProductModalBtn").modal('hide');
                        $("#editDashboard2Form")[0].reset();
                        $("#dashboard2Datatable").DataTable().ajax.reload();
                        swal.fire('Success', 'Successfully Updated', 'success');
                      }
                      else
                      {
                        swal.fire('Oops!', 'Error while updating this data!', 'error');
                      }
                    }
                  });
              });
            }
          });
      });

      // Delete Product
      $(document).on('click', '.delete', function()
      {
        var id = $(this).attr('id');

        if(confirm('Are you sure you want to remove this data?'))
        {
          $.ajax(
            {
              url:"upper/"+id,
              method:'delete',
              data:{
                '_token':'{{csrf_token()}}',
              },
              success:function(data)
              {
                if(data.success)
                {
                  $("#dashboard2Datatable").DataTable().ajax.reload();
                  swal.fire('Success', 'Successfully Removed', 'success');
                }
                else
                {
                  swal.fire('Oops!', 'Error while removing this data', 'error');
                }
              }
            });
        }
      });
      
    });
</script>
@endpush