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
        <div class="row">
          <div class="col-12">


            <div class="card">
              <div class="card-header">

                @if (Session :: has('success_message'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    {{ Session:: get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif

                <h3 class="card-title">Coupons</h3>
                <a href="{{ url('admin/add-edit-coupon') }}" style="max-width: 150px; float: right; display:inline-block;"  class="btn btn-block btn-info">Add Coupon</a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="coupons" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Coupon Type</th>
                    <th>Amount</th>
                    <th>Expiry Date</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($coupons as $coupon)
                  <tr>
                    <td>
                        {{ data_get($coupon,'id') }}

                    </td>
                   <td>
                       {{ data_get($coupon,'coupon_code') }}
                  </td>
                   <td>
                    {{ data_get($coupon,'coupon_type') }}

                   </td>
                   <td>
                    {{ data_get($coupon,'amount') }}
                    @if (data_get($coupon,'amount_type') == "Percentage")
                        %
                        @else 
                        $
                    @endif

                   </td>
                   <td>
                    {{ data_get($coupon,'expiry_date') }}

                   </td>

                    <td>
                        &nbsp;&nbsp;
                        <a title="Edit Coupon" href="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}"><i class="fas fa-edit"></i></a>
                        &nbsp;&nbsp;
                        <a title="Delete Coupon" href="javascript:void(0)" class="confirmDelete" record="coupon" recordId="{{ $coupon['id'] }}"
                             @php /* href="{{ url('admin/delete-coupon/'.$coupon['id']) }}" */ @endphp ><i class="fas fa-trash"></i></a>
                             &nbsp;&nbsp;
                             @if ($coupon['status'] == 1)
                          <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}"
                          coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                        @else
                        <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}"
                        coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                        @endif

                    </td>
                  </tr>
                  @endforeach
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
