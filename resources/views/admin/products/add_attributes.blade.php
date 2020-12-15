@extends('layouts.admin_layout.admin_layout')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Attributes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
           {{-- Laravel validation --}}

           @if ($errors->any())
           <div class="alert alert-danger" style="margin-top: 5px;">
               <ul>
                   @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                   @endforeach
               </ul>
           </div>
           @endif

           @if (Session :: has('success_message'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ Session:: get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

            @if (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                {{ Session:: get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif


        <!-- SELECT2 EXAMPLE -->
        <form action="{{ url('admin/add-attributes',$productdata['id']) }}" name="addAttributeForm" id="addAttributeForm" method="post" enctype="multipart/form-data">
         @csrf
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-6">

                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    &nbsp;
                    {{ $productdata['product_name'] }}
                  </div>

                  <div class="form-group">
                    <label for="product_code">Product Code</label>
                    &nbsp;
                    {{ $productdata['product_code'] }}
                  </div>
                  <div class="form-group">
                    <label for="product_color">Product Color</label>
                    &nbsp;
                    {{ $productdata['product_color'] }}
                  </div>
              </div>



              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                    <img style="width: 120px;margin-top:7px;" src="{{ asset('images/product_images/small/'.$productdata['main_image']) }}" alt="image">
                 </div>
              </div>
            <!-- /.end row -->


            <div class="col-md-6">
                <div class="form-group">
                    <div class="field_wrapper">
                        <div>
                            <input id="size" type="text" name="size[]" value="" placeholder="Size" style="width: 100px;" required="">
                            <input id="sku" type="text" name="sku[]" value="" placeholder="SKU" style="width: 100px;" required="">
                            <input id="price" type="number" name="price[]" value="" placeholder="Price" style="width: 100px;" required="">
                            <input id="stock" type="number" name="stock[]" value="" placeholder="Stock" style="width: 100px;" required="">

                            <a href="javascript:void(0);" class="add_button" title="Add attribute">Add</a>
                        </div>
                    </div>
                </div>
            </div>




          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add Attributes</button>
          </div>
        </div>
       </form>
        <!-- /.card -->

        {{-- display data --}}
     <form name="editAttributesForm" id="editAttributesForm" method="post" action="{{ url('admin/edit-attributes',$productdata['id']) }}">
        @csrf
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Added Products Attributes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="products" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Size</th>
                  <th>SKU</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
              @foreach ($productdata['attributes'] as $attribute)
              <input style="display: none;" type="text" name="attrId[]" value="{{ $attribute['id'] }}">
                <tr>
                  <td>{{ $attribute['id'] }}</td>
                  <td>{{ $attribute['size'] }}</td>
                  <td>{{ $attribute['sku'] }}</td>
                  <td>
                      <input type="number" name="price[]" value="{{ $attribute['price'] }}" required="">
                  </td>
                  <td>
                    <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required="">
                 </td>
                  <td>

                       @if ($attribute['status'] == 1)
                       <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}"
                         attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">Active</a>
                     @else
                     <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}"
                         attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">Inactive</a>
                     @endif

                     &nbsp;&nbsp;
                     <a title="Delete Attribute" href="javascript:void(0)" class="confirmDelete" record="attribute" recordId="{{ $attribute['id'] }}"
                          @php /* href="{{ url('admin/delete-attribute/'.$attribute['id']) }}" */ @endphp ><i class="fas fa-trash"></i></a>




                    </td>

                </tr>
                @endforeach
                </tbody>

              </table>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Attributes</button>
            </div>
            <!-- /.card-body -->
          </div>

        </form>
          {{-- display data --}}

          <!-- /.card -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

