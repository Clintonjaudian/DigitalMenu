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
                <h1 class="m-0 text-dark">Menu 1</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Upper Right</li>
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
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addUpperRightProductModalBtn">Add Product</button>
                </div>

                <table id="upperRightDatatable" class="table table-bordered table-striped" width="100%">
                    <thead>
                    <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Food Image</th>
                    <th>Upper Right Price Tag</th>
                    <th>Lower Right Price Tag</th>
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


{{-- Add New Product For Upper Left Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="addUpperRightProductModalBtn">
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
                <form method="POST" id="addUpperRightForm" enctype="multipart/form-data"> 
                  @csrf

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="product" class="control-label">Product Name</label>
                      <input id="product" name="product" type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-6">
                      <label for="price" class="control-label">Price</label>
                      <input id="price" name="price" type="number" class="form-control" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="food_image" class="control-label">Select Food Image</label>
                      <input id="food_image" name="food_image" type="file" required>
                    </div>

                    <div class="form-group col-6">
                      <label for="original_price" class="control-label">Select Upper Right Price Tag</label>
                      <input id="original_price" name="original_price" type="file" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="dou_price" class="control-label">Select Lower Right Price Tag</label>
                      <input id="dou_price" name="dou_price" type="file" required>
                    </div>
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="addUpperRightCancelBtn">Cancel</button>
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

{{-- Edit Product For Upper Left Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="editUpperRightProductModalBtn">
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
                <form method="POST" id="editUpperRightForm" enctype="multipart/form-data"> 
                  @csrf
                  @method('PUT')
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="edit_product" class="control-label">Edit Product Name</label>
                      <input id="edit_product" name="edit_product" type="text" class="form-control" required>
                    </div>

                    <div class="form-group col-3">
                      <label for="edit_price" class="control-label">Edit Price</label>
                      <input id="edit_price" name="edit_price" type="number" class="form-control" required>
                    </div>

                    <div class="form-group col-3">
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
                      <label for="edit_original_price" class="control-label">Edit Upper Right Price Tag</label>
                      <br>
                      <input id="edit_original_price" name="edit_original_price" type="file">
                      <br>
                      <img src="" alt="Original Price" title="Original Price" id="current_original_price" class="img-thumbnail" width="100">
                      <input type="hidden" name="hidden_original_price" id="hidden_original_price">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="edit_dou_price" class="control-label">Edit Lower Right Price Tag</label>
                      <br>
                      <input id="edit_dou_price" name="edit_dou_price" type="file">
                      <br>
                      <img src="" alt="Dou Price" title="Dou Price" id="current_dou_price" class="img-thumbnail" width="100">
                      <input type="hidden" name="hidden_dou_price" id="hidden_dou_price">
                    </div>
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="editUpperRightCancelBtn">Cancel</button>
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
            $("#upperRightDatatable").DataTable(
            {
                processing:true,
                serverSide:true,
                ajax:{
                    url:"{{route('upper_right_menu1.index')}}"
                },
                columns:[
                    {
                    data:'product_name',
                    name:'product_name',
                    },
                    {
                    data:'price',
                    name:'price',
                    },
                    {   
                    data:'food_image',
                    render:function(data)
                    {
                        return '<img src="{{ URL::to("/") }}/assets/images/'+data+'" class="img-thumbnail" width="75" />';
                    }
                    },
                    {   
                    data:'price_tag',
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
            $("#addUpperRightForm").parsley();

            // Cancel Btn when adding product
            $("#addUpperRightCancelBtn").on('click', function()
            {
            $("#addUpperRightForm").parsley().reset();
            $("#addUpperRightForm")[0].reset();
            });

            // Add Product
            $("#addUpperRightForm").on('submit', function(event)
            {
                event.preventDefault();
                var formData = new FormData($(this)[0]);
            
                $.ajax(
                {
                    url:"{{route('upper_right_menu1.store')}}",
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
                        $("#addUpperRightProductModalBtn").modal('hide');
                        $("#addUpperRightForm")[0].reset();
                        $('#addUpperRightForm').parsley().reset();
                        $("#upperRightDatatable").DataTable().ajax.reload();
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
                    url:"upper_right_menu1/"+id+"/edit",
                    dataType:'json',
                    success:function(data)
                    {
                        $("#edit_product").val(data.productData.product_name);
                        $("#edit_price").val(data.productData.price);
                        $("#edit_status").val(data.productData.status);
                        $("#hidden_food_image").val(data.productData.food_image);
                        $("#current_food_image").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.food_image);
                        $("#hidden_original_price").val(data.productData.price_tag);
                        $("#current_original_price").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.price_tag);
                        $("#hidden_dou_price").val(data.productData.dou_price);
                        $("#current_dou_price").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.dou_price);
                    
                        $("#editUpperRightProductModalBtn").modal('show');

                        // Submation of edited data
                        $("#editUpperRightForm").unbind('submit').bind('submit', function(event)
                        {
                            event.preventDefault();
                            var formData = new FormData($(this)[0]);

                            $.ajax(
                            {
                                url:"upper_right_menu1/"+id,
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
                                        $("#editUpperRightProductModalBtn").modal('hide');
                                        $("#editUpperRightForm")[0].reset();
                                        $("#editUpperRightForm").parsley().reset();
                                        $("#upperRightDatatable").DataTable().ajax.reload();
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
                    url:"upper_right_menu1/"+id,
                    method:'delete',
                    data:{
                        '_token':'{{csrf_token()}}',
                    },
                    success:function(data)
                    {
                        if(data.success)
                        {
                            $("#upperRightDatatable").DataTable().ajax.reload();
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