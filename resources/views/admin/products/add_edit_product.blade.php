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
              <li class="breadcrumb-item active">Products</li>
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


        <!-- SELECT2 EXAMPLE -->
      <form @if (empty($productdata['id'])) action="{{ url('admin/add-edit-product') }}"
      @else action="{{ url('admin/add-edit-product/'.$productdata['id']) }}" @endif  name="productForm" id="productForm"
      method="post" enctype="multipart/form-data">
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
                    <label>Select Category</label>
                    <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach ($categories as $section)
                         <optgroup label="{{ $section['name'] }}"></optgroup>
                             @foreach ($section['categories'] as $category)
                                 <option value="{{ $category['id'] }}" @if(!empty(@old('category_id')) && $category['id'] == @old('category_id')) selected=""
                                 @elseif(!empty($productdata['category_id']) &&  $productdata['category_id'] == $category['id']) selected=""
                                 @endif>&nbsp;&nbsp;--&nbsp;&nbsp;{{ $category['category_name'] }}</option>
                                    @foreach ($category['subcategories'] as $subCategory)
                                     <option value="{{ $subCategory['id'] }}" @if (!empty(@old('category_id')) && $subCategory['id'] == @old('category_id')) selected=""
                                     @elseif(!empty($productdata['category_id']) &&  $productdata['category_id'] == $subCategory['id']) selected=""
                                     @endif >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $subCategory['category_name'] }}</option>
                                    @endforeach
                                @endforeach
                         @endforeach
                    </select>
                  </div>

                <div class="form-group">
                    <label>Select Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                    @foreach ($brands as $brand)
                     <option value="{{ $brand['id'] }}" @if(!empty(@old('brand_id')) && $brand['id'] == @old('brand_id')) selected=""
                     @elseif(!empty($productdata['brand_id']) &&  $productdata['brand_id'] == $brand['id']) selected=""
                     @endif>{{ $brand['name'] }}</option>
                    @endforeach
                    </select>
                </div>


              </div>



              <div class="col-md-6">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter Product name"
                    @if (!empty($productdata['product_name']))
                    value="{{ $productdata['product_name'] }}"
                    @else
                   value="{{ old('product_name') }}"
                    @endif>
                  </div>

                <div class="form-group">
                    <label for="product_code">Product Code</label>
                    <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Enter Product Code"
                    @if (!empty($productdata['product_code']))
                    value="{{ $productdata['product_code'] }}"
                    @else
                   value="{{ old('product_code') }}"
                    @endif>
                  </div>

              </div>


              <div class="col-md-6">
                <div class="form-group">
                    <label for="product_color">Product Color</label>
                    <input type="text" class="form-control" name="product_color" id="product_color" placeholder="Enter Product Color"
                    @if (!empty($productdata['product_color']))
                    value="{{ $productdata['product_color'] }}"
                    @else
                   value="{{ old('product_color') }}"
                    @endif>
                  </div>


                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" class="form-control" name="product_price" id="product_price" placeholder="Enter Product Price"
                    @if (!empty($productdata['product_price']))
                    value="{{ $productdata['product_price'] }}"
                    @else
                   value="{{ old('product_price') }}"
                    @endif>
                  </div>

              </div>



              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                    <label for="product_discount">Product Discount (%)</label>
                    <input type="text" class="form-control" name="product_discount" id="product_discount" placeholder="Enter Product Discount"
                    @if (!empty($productdata['product_discount']))
                    value="{{ $productdata['product_discount'] }}"
                    @else
                   value="{{ old('product_discount') }}"
                    @endif>
                  </div>


                <div class="form-group">
                    <label for="product_weight">Product Weight</label>
                    <input type="text" class="form-control" name="product_weight" id="product_weight" placeholder="Enter Product Weight"
                    @if (!empty($productdata['product_weight']))
                    value="{{ $productdata['product_weight'] }}"
                    @else
                   value="{{ old('product_weight') }}"
                    @endif>
                  </div>

              </div>

            </div>
            <!-- /.end row -->

            <div class="row">
              <div class="col-12 col-sm-6">

                <div class="form-group">
                    <label for="main_image">Product Main Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="main_image" name="main_image">
                        <label class="custom-file-label" for="main_image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                    <div>Recommended Image Size:(1040px,Heght:1200px)</div>

                    @if (!empty($productdata['main_image']))
                    <div style="height: 100px;">
                    <img style="width: 70px;margin-top:7px;" src="{{ asset('images/product_images/small/'.$productdata['main_image']) }}" alt="image-potion">
                    &nbsp;
                    <a class="confirmDelete" href="javascript:void(0)" record="product-image" recordId="{{ $productdata['id'] }}" @php /*href="{{ url('admin/delete-category-image/'.$categorydata['id']) }}" */ @endphp >Delete Image</a>
                    </div>
                    @endif
                  </div>

                <div class="form-group">
                    <label for="product_video">Product Video</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="product_video" name="product_video">
                        <label class="custom-file-label" for="product_video">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>

                    @if (!empty($productdata['product_video']))
                    <div>
                    <a href="{{ url('videos/product_videos/'.$productdata['product_video']) }}" download>Download</a>
                    &nbsp;|
                    &nbsp;
                    <a class="confirmDelete" href="javascript:void(0)" record="product-video" recordId="{{ $productdata['id'] }}" @php /*href="{{ url('admin/delete-category-image/'.$categorydata['id']) }}" */ @endphp >Delete Video</a>

                    </div>
                    @endif
                  </div>

                <!-- /.form-group -->
              </div>
              <!-- /.col -->


              <div class="col-12 col-sm-6">

                <div class="form-group">
                    <label for="description">Product Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter ...">
                        @if (!empty($productdata['description']))
                        {{ $productdata['description'] }}
                        @else
                       {{ old('description') }}
                        @endif
                    </textarea>
                  </div>


                <div class="form-group">
                    <label for="wash_care">Wash Care</label>
                    <textarea class="form-control" id="wash_care" name="wash_care" rows="3" placeholder="Enter ...">
                        @if (!empty($productdata['wash_care']))
                        {{ $productdata['wash_care'] }}
                        @else
                       {{ old('wash_care') }}
                        @endif
                    </textarea>
                  </div>


              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Select Febric</label>
                    <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                    @foreach ($fabricArray as $fabric)
                     <option value="{{ $fabric }}" @if(!empty(@old('fabric')) && $fabric == @old('fabric')) selected=""
                     @elseif(!empty($productdata['fabric']) &&  $productdata['fabric'] == $fabric) selected=""
                     @endif>{{ $fabric }}</option>
                    @endforeach
                    </select>
                  </div>


                <div class="form-group">
                    <label>Select Sleeve</label>
                    <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                    @foreach ($sleeveArray as $sleeve)
                     <option value="{{ $sleeve }}" @if(!empty(@old('sleeve')) && $sleeve == @old('sleeve')) selected=""
                     @elseif(!empty($productdata['sleeve']) &&  $productdata['sleeve'] == $sleeve) selected=""
                     @endif>{{ $sleeve }}</option>
                    @endforeach
                    </select>
                </div>

             </div>

             <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Select Pattern</label>
                    <select name="pattern" id="pattern" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                    @foreach ($PatternArray as $pattern)
                     <option value="{{ $pattern }}" @if(!empty(@old('pattern')) && $pattern == @old('pattern')) selected=""
                     @elseif(!empty($productdata['pattern']) &&  $productdata['pattern'] == $pattern) selected=""
                     @endif>{{ $pattern }}</option>
                    @endforeach
                    </select>
                  </div>

                <div class="form-group">
                    <label>Select Fit</label>
                    <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                    @foreach ($fitArray as $fit)
                     <option value="{{ $fit }}" @if(!empty(@old('fit')) && $fit == @old('fit')) selected=""
                     @elseif(!empty($productdata['fit']) &&  $productdata['fit'] == $fit) selected=""
                     @endif>{{ $fit }}</option>
                    @endforeach
                    </select>
                  </div>

             </div>


                 <!-- /.col -->
                 <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Select Occasion</label>
                        <select name="occasion" id="occasion" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                        @foreach ($occasionArray as $occasion)
                         <option value="{{ $occasion }}" @if(!empty(@old('occasion')) && $occasion == @old('occasion')) selected=""
                         @elseif(!empty($productdata['occasion']) &&  $productdata['occasion'] == $occasion) selected=""
                         @endif>{{ $occasion }}</option>
                        @endforeach
                        </select>
                      </div>

                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ...">
                             @if (!empty($productdata['meta_title']))
                       {{ $productdata['meta_title'] }}
                      @else
                      {{ old('meta_title') }}
                      @endif</textarea>
                      </div>


                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->

                     <!-- /.col -->
                 <div class="col-12 col-sm-6">

                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter ..."
                       >
                       @if (!empty($productdata['meta_description']))
                       {{ $productdata['meta_description'] }}
                     @else
                      {{ old('meta_description') }}
                     @endif
                    </textarea>
                    </div>

                      <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter ..."
                       >
                       @if (!empty($productdata['meta_keywords']))
                       {{ $productdata['meta_keywords'] }}
                       @else
                     {{ old('meta_keywords') }}
                       @endif
                    </textarea>
                      </div>

                  </div>
                  <!-- /.col -->

                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="is_featured">Is Featured</label>
                        <input type="checkbox" name="is_featured" id="is_featured"  value="Yes"
                        @if(!empty($productdata['is_featured']) &&  $productdata['is_featured'] == "Yes") checked="" @endif
                        >
                      </div>
                  </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
       </form>
        <!-- /.card -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

