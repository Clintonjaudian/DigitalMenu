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
                <h1 class="m-0 text-dark">Right Side</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard 2</li>
                    <li class="breadcrumb-item active">Right Side</li>
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
                <h3 class="card-title">Product Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                <div class="float-right">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addRightSideProductModalBtn">Add Product</button>
                </div>

                <table id="rightSideDatatable" class="table table-bordered table-striped" width="100%">
                    <thead>
                    <tr>
                    <th>Product Classification</th>
                    <th>Price Tag</th>
                    <th>Product Image</th>
                    <th>Status</th>
                    <th>Add-on</th>
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

{{-- Add New Product For Right Side Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="addRightSideProductModalBtn">
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
                <form method="POST" id="addRightSideForm" enctype="multipart/form-data"> 
                  @csrf

                  <div class="row">
                    <div class="form-group col-12">
                      <label for="classification" class="control-label">Classification</label>
                      <input id="classification" name="classification" class="form-control" type="text" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="product_image" class="control-label col-12">Select Product Image</label>
                      <input id="product_image" name="product_image" type="file" required>
                    </div>

                    <div class="form-group col-6">
                      <label for="price_tag" class="control-label col-12">Select Price Tag</label>
                      <input id="price_tag" name="price_tag" type="file" required>
                    </div>
                  </div>

                  <br>
                  <h4>Add-on Product</h4>
                  <div class="row">
                    <table class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th>Add-on Name</th>
                          <th width="20%">Pcs</th>
                          <th width="20%">Action</th>
                        </tr>
                      </thead>
                      <tbody id="add_addon_table">

                      </tbody>
                    </table>
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="addRightSideCancelBtn">Cancel</button>
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

{{-- Edit Product For Right Side Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="editRightSideProductModalBtn">
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
                <form method="POST" id="editRightSideForm" enctype="multipart/form-data"> 
                  @csrf
                  @method('PUT')
                  <div class="row">
                    <div class="form-group col-md-8">
                      <label for="edit_classification" class="control-label">Classification</label>
                      <input id="edit_classification" name="edit_classification" class="form-control" type="text" required>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="edit_status" class="control-label">Status</label>
                      <select  id="edit_status" name="edit_status" type="number" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inctive</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="edit_image_product" class="control-label">Select Food Image</label>
                      <br>
                      <input id="edit_product_image" name="edit_product_image" type="file">
                      <input type="hidden" id="hidden_product_image" name="hidden_product_image">
                      <br>
                      <img src="" id="current_product_image" alt="Current Image" class="img-thumbnail" width="100">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="edit_price_tag" class="control-label">Select Price Tag</label>
                      <br>
                      <input id="edit_price_tag" name="edit_price_tag" type="file">
                      <input type="hidden" id="hidden_price_tag" name="hidden_price_tag">
                      <br>
                      <img src="" id="current_price_tag" alt="Price Tag" class="img-thumbnail" width="100">
                    </div>
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="editRightSideCancelBtn">Cancel</button>
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

{{-- Show Add-on Modal --}}
<div class="modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" id="add_on_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">

              <div class="card-header">
                <h3 class="card-title">Add-on Details</h3>
              </div>

              <div class="card-body">
              <div class="float-right">
                <button type="button" class="btn btn-info" id="addBtn">Add Add-on Product</button>
              </div>
              <br><br>
               <table class="table table-bordered table-striped" id="add_on_table" width="100%">
                <thead>
                  <tr>
                    <th>Add-on</th>
                    <th with="10%">Pieces</th>
                    <th with="20%">Status</th>
                    <th with="20%">Action</th>
                  </tr>
                </thead>
                <tbody id="add_on_tbody">

                </tbody>
               </table>
               
               <br>
                <div class="form-group float-right">
                  <button type="button" class="btn btn-success" data-dismiss="modal" id="closeBtn">Close</button>
                </div>
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

{{-- Edit Add-on Modal --}}
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="edit_addon_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">

              <div class="card-header">
                <h3 class="card-title">Edit Add-on</h3>
              </div>

              <div class="card-body">
                <form method="POST" id="edit_addon_form">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                    <label for="edit_addon">Add-on</label>
                    <input type="text" id="edit_addon" name="edit_addon" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="edit_pcs">Pieces</label>
                    <input type="number" id="edit_pcs" name="edit_pcs" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="edit_addon_status">Status</label>
                    <select name="edit_addon_status" id="edit_addon_status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="editAddonCloseBtn">Cancel</button>
                    <button type="submit" class="btn btn-info">Submit</button>
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

{{-- Add Add-on Modal --}}
<div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="addRightSideAddonModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">

              <div class="card-header">
                <h3 class="card-title">Add Add-on Product</h3>
              </div>

              <div class="card-body">
                <form method="POST" id="add_on_form">
                  @csrf
                  <input type="hidden" name="right_side_id" id="right_side_id">
                  <table class="table table-bordered table-striped" with="100%" id="add_add_on_table">
                    <thead>
                      <tr>
                        <th>Add-on</th>
                        <th width="30%">Pieces</th>
                        <th width="20%">Action</th>
                      </tr>
                    </thead>
                    <tbody id="add_add_on_tbody">

                    </tbody>
                  </table>

                  <div class="form-group float-right">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="addonCancelBtn">Cancel</button>
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
        // Modal Multiple Popup
        var modal_lv = 0;
        $('.modal').on('shown.bs.modal', function(e) {
          $('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
          $(e.currentTarget).css('zIndex', 1052 + modal_lv);
          modal_lv++
        });

        $('.modal').on('hidden.bs.modal', function(e) {
          modal_lv--
        });

        // Yajra DataTable
        $("#rightSideDatatable").DataTable(
        {
            processing:true,
            serverSide:true,
            ajax:{
                url:"{{route('right_side.index')}}"
            },
            columns:[
                {
                  data:'classification',
                  name:'classification',
                },
                {   
                  data:'price_tag',
                  render:function(data)
                  {
                    return '<img src="{{ URL::to("/") }}/assets/images/'+data+'" class="img-thumbnail" width="75" />';
                  }
                },
                {   
                  data:'product_image',
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
                  data:'add_on',
                  name:'add_on',
                  orderable:false
                },
                {
                  data:'action',
                  name:'action',
                  orderable:false
                }
            ]
        });

        // Parsley Validator
        $("#addRightSideForm").parsley();
        $("#add_on_form").parsley();

        // Cancel Btn when adding product
        $("#addRightSideCancelBtn").on('click', function()
        {
          dynamic_field(1);
          $("#addRightSideForm").parsley().reset();
          $("#addRightSideForm")[0].reset();
        });

        // Dynamic Field  Product
        var count = 1;
        function dynamic_field(count)
        {
          var html = '<tr>';
          html += '<td><input type="text" name="add_on[]" class="form-control" required></td>';
          html += '<td><input type="number" name="pcs[]" class="form-control" required></td>';

          if(count > 1)
          {
            html += '<td><button type="button" name="remove" class="btn btn-danger remove" title="Remove"><i class="fas fa-trash"></i></button></td></tr>';
            $("#add_addon_table").append(html);
          }
          else
          {
            html += '<td><button type="button" name="add" id="add" class="btn btn-success" title="Add"><i class="fas fa-plus-circle"></i></button></td></tr>';
            $("#add_addon_table").html(html);
          }
        }

        dynamic_field(count);
        // To Add input field when add btn is click
        $(document).on('click', '#add', function()
        {
          count++;
          dynamic_field(count);
        });

        // To remove input field when remove btn is click
        $("#add_addon_table").on('click', '.remove', function()
        {
          count--;
          $(this).parent().parent().remove();
        });

        // Add Product
        $("#addRightSideForm").on('submit', function(event)
        {
          event.preventDefault();
          var formData = new FormData($(this)[0]);
        
          $.ajax(
            {
              url:"{{route('right_side.store')}}",
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
                  if(data.validator)
                  {
                    $("#addRightSideProductModalBtn").modal('hide');
                    $("#addRightSideForm")[0].reset();
                    $('#addRightSideForm').parsley().reset();
                    $("#rightSideDatatable").DataTable().ajax.reload();
                    Swal.fire('Success', 'Successfully Added', 'success');
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
              url:"right_side/"+id+"/edit",
              dataType:'json',
              success:function(data)
              {
                $("#edit_classification").val(data.productData.classification);
                $("#edit_status").val(data.productData.status);
                $("#hidden_product_image").val(data.productData.product_image);
                $("#hidden_price_tag").val(data.productData.price_tag);
                $("#current_product_image").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.product_image);
                $("#current_price_tag").attr('src', "{{URL::to('/')}}/assets/images/"+data.productData.price_tag);

                $("#editRightSideProductModalBtn").modal('show');

                // Submation of edited data
                $("#editRightSideForm").unbind('submit').bind('submit', function(event)
                {
                  event.preventDefault();
                  var formData = new FormData($(this)[0]);

                  $.ajax(
                    {
                      url:"right_side/"+id,
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
                          $("#editRightSideProductModalBtn").modal('hide');
                          $("#editRightSideForm")[0].reset();
                          $("#editRightSideForm").parsley().reset();
                          $("#rightSideDatatable").DataTable().ajax.reload();
                          swal.fire('Success', 'Successfully Updated', 'success');
                        }
                        else
                        {
                          swal.fire('Oops!', 'Error while updating this data!', 'error');
                        }
                      }
                    });
                })
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
                url:"right_side/"+id,
                method:'delete',
                data:{
                  '_token':'{{csrf_token()}}',
                },
                success:function(data)
                {
                  if(data.validator)
                  {
                    $("#rightSideDatatable").DataTable().ajax.reload();
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


        /* Add-on
        ====================================================================*/
        // Add-on Btn

        var id = '';

        $(document).on('click', '.add_on', function()
        {
          id = $(this).attr('id');
          $("#right_side_id").val(id);
          add_on_data(id)
        });

        function add_on_data(id)
        {
          $.ajax(
            {
              url:"{{route('right_side.add_on')}}",
              method:'post',
              data:{
                id:id,
                '_token':'{{csrf_token()}}'
              },
              dataType:'json',
              success:function(data)
              {
                var output = '';

                if(data.add_on_data.length > 0)
                {

                  for(var count = 0; count < data.add_on_data.length; count++ )
                  {
                    output += '<tr>';
                    output += '<td>'+data.add_on_data[count].add_on+'</td>';
                    output += '<td>'+data.add_on_data[count].pcs+'</td>';
                    output += '<td>';
                                if(data.add_on_data[count].status == 1)
                                {
                                  output += '<span class="badge badge-success">Active</span>';
                                }
                                if(data.add_on_data[count].status == 0)
                                {
                                  output += '<span class="badge badge-warning">Inactive</span>';
                                }
                    output += '</td>';
                    output += '<td><button class="btn btn-info btn-xs edit_addon" id="'+data.add_on_data[count].id+'" title="Edit"><i class="fa fa-edit"></i></button>'+
                              '&nbsp;&nbsp;<button class="btn btn-danger btn-xs delete_addon" id="'+data.add_on_data[count].id+'" title="Delete"><i class="fa fa-trash"></i></button></td>';
                  }
                }
                else
                {
                  output += '<tr><td colspan="4"><center>No Data Available</center></td></tr>';
                }

                $("#add_on_tbody").html(output);
                $("#add_on_modal").modal('show');
              }
            });
        }

        // Add Add-on Modal Pop-up
        $("#addBtn").on('click', function()
        {
          addon_dynamic_field(1);
          $("#addRightSideAddonModal").modal('show');
        });

        // Submit Add-on
        $("#add_on_form").on('submit', function(event)
        {
          event.preventDefault();
          $.ajax(
            {
              url:"{{route('addon.store')}}",
              method:"post",
              data:$(this).serialize(),
              dataType:"json",
              success:function(data)
              {
                if(data.exist)
                {
                  alert('This add-on product is already exist!');
                }
                else
                {
                  if(data.validator)
                  {
                    addon_dynamic_field(1);
                    add_on_data(id);
                    $("#addRightSideAddonModal").modal('hide');
                    swal.fire('Success', 'Successfully Added', 'success');
                    $("#add_on_form")[0].reset();
                    $('#add_on_form').parsley().reset();
                  }
                  else
                  {
                    swal.fire('Oops!', 'Error while adding this data', 'error');
                  }
                }
              }
            });
        });

        // Edit Add-on
        var addon_id = '';
        $(document).on('click', '.edit_addon', function()
        {
          addon_id = $(this).attr('id');

          $.ajax(
            {
              url:"addon/"+addon_id+"/edit",
              dataType:"json",
              success:function(data)
              {
                $("#edit_addon").val(data.addon_data.add_on);
                $("#edit_pcs").val(data.addon_data.pcs);
                $("#edit_addon_status").val(data.addon_data.status);
                $("#edit_addon_modal").modal('show');
              }
            });
        });

        // Submit Edit Add-on
        $("#edit_addon_form").on('submit', function(event)
        {
          event.preventDefault();

          $.ajax(
            {
              url:'addon/'+addon_id,
              method:"post",
              data:$(this).serialize(),
              dataType:'json',
              success:function(data)
              {
                if(data.validator)
                {
                  add_on_data(id);
                  $("#edit_addon_modal").modal('hide');
                  swal.fire('Success', 'Successfully Updated', 'success');
                }
                else
                {
                  swal.fire('Oops!', 'Error while updating this data', 'error');
                }
              }
            });
        });

        // Remove Add-on
        $(document).on('click', '.delete_addon', function()
        {
          var addon_id = $(this).attr('id');

          if(confirm('Are you sure you want to remove this data?'))
          {
            $.ajax(
              {
                url:"addon/"+addon_id,
                method:'delete',
                data:{
                  '_token':'{{csrf_token()}}',
                },
                success:function(data)
                {
                  if(data.validator)
                  {
                    swal.fire('Success', 'Successfully Removed', 'success');
                    add_on_data(id);
                  }
                  else
                  {
                    swal.fire('Oops!', 'Error while removing this data', 'error');
                  }
                }
              });
          }
        });

        // Dynamic Field  Product
        var addon_count = 1;
        function addon_dynamic_field(addon_count)
        {
          var html = '<tr>';
          html += '<td><input type="text" name="add_addon[]" class="form-control" required></td>';
          html += '<td><input type="number" name="add_pcs[]" class="form-control" required></td>';

          if(addon_count > 1)
          {
            html += '<td><button type="button" name="remove" class="btn btn-danger remove" title="Remove"><i class="fas fa-trash"></i></button></td></tr>';
            $("#add_add_on_tbody").append(html);
          }
          else
          {
            html += '<td><button type="button" name="add" id="add_addon" class="btn btn-success" title="Add"><i class="fas fa-plus-circle"></i></button></td></tr>';
            $("#add_add_on_tbody").html(html);
          }
        }

        addon_dynamic_field(addon_count);
        // To Add input field when add btn is click
        $(document).on('click', '#add_addon', function()
        {
          addon_count++;
          addon_dynamic_field(addon_count);
        });

        // To remove input field when remove btn is click
        $("#add_add_on_tbody").on('click', '.remove', function()
        {
          addon_count--;
          $(this).parent().parent().remove();
        });

        // Dynamic Add-on Cancel Btn
        $("#addonCancelBtn").on('click', function()
        {
          addon_dynamic_field(1);
          $("#add_on_modal").modal('show');
        });
        

      });
    </script>
@endpush