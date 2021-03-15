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
              <li class="breadcrumb-item active">Coupons</li>
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
      <form @if (empty($coupondata['id'])) action="{{ url('admin/add-edit-coupon') }}"
      @else action="{{ url('admin/add-edit-coupon/'.$coupondata['id']) }}" @endif  name="bannerForm" id="bannerForm"
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

              <div class="col-sm-6">
                <div class="form-group">
                    @if (!isset($coupondata['coupon_code']))

                    <label for="title">Coupon Option</label> <br>
                    <input type="radio" name="coupon_option" id="AutomaticCoupon"
                   value="Automatic" checked="">Automatic &nbsp;&nbsp;
                    <input type="radio"  name="coupon_option" id="ManualCoupon"
                   value="Manual" >Manual &nbsp;&nbsp;
                  </div>

                <div class="form-group" style="display: none;" id="couponField">
                    <label for="coupon_code">Coupon Code</label>
                    <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code"
                    @if (!empty($coupondata['coupon_code']))
                    value="{{ $coupondata['coupon_code'] }}"
                    @else
                   value="{{ old('coupon_code') }}"
                    @endif>
                  </div>

                  @else

                  <div class="form-group" >
                    <input type="hidden" name="coupon_option" value="{{ $coupondata['coupon_option'] }}">
                    <input type="hidden" name="coupon_code" value="{{ $coupondata['coupon_code'] }}">
                    <label for="coupon_code">Coupon Code: &nbsp;</label>
                   <span>{{ $coupondata['coupon_code'] }}</span>
                  </div>

                  @endif

              </div>




              <div class="col-sm-6">
                <div class="form-group">
                    <label for="alt">Select Categories</label>
                    <select name="categories[]" class="form-control select2" multiple>
                        <option value="">Select</option>
                        @foreach ($categories as $section)
                         <optgroup label="{{ $section['name'] }}"></optgroup>
                             @foreach ($section['categories'] as $category)
                                 <option value="{{ $category['id'] }}" @if (in_array($category['id'],$selCats))
                                 selected=""
                                 @endif>&nbsp;&nbsp;--&nbsp;&nbsp;{{ $category['category_name'] }}</option>
                                    @foreach ($category['subcategories'] as $subCategory)
                                     <option value="{{ $subCategory['id'] }}" @if (in_array($subCategory['id'],$selCats))
                                     selected=""
                                     @endif >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $subCategory['category_name'] }}</option>
                                    @endforeach
                                @endforeach
                         @endforeach
                    </select>
                  </div>


                  <div class="form-group">
                    <label for="image">Select Users</label>

                    <select name="users[]" class="form-control select2" multiple data-live-search="true">
                        <option value="">Select</option>
                        @foreach ($users as $user)
                        <option value="{{ $user['email'] }}" @if (in_array($user['email'],$selUsers))
                        selected=""
                        @endif>{{ $user['email'] }}</option>
                        @endforeach
                    </select>
                  </div>

              </div>


              <div class="col-sm-6">
                <div class="form-group">
                    <label for="title">Coupon Type</label> <br>
                    <input type="radio" name="coupon_type" value="Multiple Times"
                    @if (isset($coupondata['coupon_type']) && $coupondata['coupon_type'] == "Multiple Times")
                   value="Multiple Times" checked="" @elseif(!isset($coupondata['coupon_type'])) checked=""
                    @endif>Multiple Times &nbsp;&nbsp;
                    <input type="radio"  name="coupon_type"  value="Single Times"
                    @if (isset($coupondata['coupon_type']) && $coupondata['coupon_type'] == "Single Times")
                    value="Single Times" checked=""
                     @endif>Single Times &nbsp;&nbsp;
                  </div>


                  <div class="form-group">
                    <label for="image">Amount Types</label> <br>
                    <input type="radio" name="amount_type"  value="Percentage"
                    @if (isset($coupondata['amount_type']) && $coupondata['amount_type'] == "Percentage") checked=""
                    @elseif(!isset($coupondata['amount_type'])) checked=""
                    @endif >Percentage(%) &nbsp;&nbsp;
                    <input type="radio"  name="amount_type"  value="Fixed"
                    @if (isset($coupondata['amount_type']) && $coupondata['amount_type'] == "Fixed") checked=""
                    @endif> Fixed &nbsp;&nbsp;
                  </div>
                  <div class="form-group">
                  <label for="coupon_code">Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount"
                    @if (!empty($coupondata['amount']))
                    value="{{ $coupondata['amount'] }}"
                    @else
                   value="{{ old('amount') }}"
                    @endif>
                  </div>

              </div>


              <div class="col-sm-6">
                <div class="form-group">
                    <label for="coupon_code">Expiry Date</label>
                    <input type="text" class="form-control" name="expiry_date" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" placeholder="yyyy/mm/dd" data-mask
                    @if (!empty($coupondata['expiry_date']))
                    value="{{ $coupondata['expiry_date'] }}"
                    @else
                   value="{{ old('expiry_date') }}"
                    @endif>
                  </div>



              </div>

            </div>
            <!-- /.end row -->

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

