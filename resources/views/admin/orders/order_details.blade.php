
@php
use App\Product;
use Illuminate\Support\Facades\Session;
@endphp

@extends('layouts.admin_layout.admin_layout')
@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Order #{{ $orderDetails['id'] }} Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Order Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <td colspan="2"> <Strong>Order Details</Strong></td>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td>{{  date('d-m-Y', strtotime(data_get($orderDetails,'created_at'))) }}</td>
                        </tr>
                        <tr>
                            <td>Order Status</td>
                            <td>{{ data_get($orderDetails,'order_status') }}</td>
                        </tr>

                        <tr>
                            <td>Order Total</td>
                            <td>${{ data_get($orderDetails,'grand_total') }}</td>
                        </tr>

                        <tr>
                            <td>Shipping Charges</td>
                            <td>{{ data_get($orderDetails,'shipping_charges') }}</td>
                        </tr>
                        <tr>
                            <td>Coupon Code</td>
                            <td>{{ data_get($orderDetails,'coupon_code') }}</td>
                        </tr>
                        <tr>
                            <td>Coupon Amount</td>
                            <td>{{ data_get($orderDetails,'coupon_amount') }}</td>
                        </tr>

                        <tr>
                            <td>Payment Method</td>
                            <td>{{ data_get($orderDetails,'payment_method') }}</td>
                        </tr>

                        <tr>
                            <td>Payment Gateway</td>
                            <td>{{ data_get($orderDetails,'payment_gateway') }}</td>
                        </tr>

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->

              </div>
              <!-- /.card -->

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Delivery Adresses</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-sm">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"> <Strong>Delivery Address</Strong></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ data_get($orderDetails,'name') }}</td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td>{{ data_get($orderDetails,'address') }}</td>
                        </tr>

                        <tr>
                            <td>City</td>
                            <td>{{ data_get($orderDetails,'city') }}</td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>{{ data_get($orderDetails,'state') }}</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{ data_get($orderDetails,'country') }}</td>
                        </tr>
                        <tr>
                            <td>Pincode</td>
                            <td>{{ data_get($orderDetails,'pincode') }}</td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>{{ data_get($orderDetails,'mobile') }}</td>
                        </tr>

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Customer Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>

                      </thead>
                      <tbody>
                          <tr>
                              <td colspan="2"> <Strong>Customer Details</Strong></td>
                          </tr>
                          <tr>
                              <td>Name</td>
                              <td>{{ data_get($userDetails,'name') }}</td>
                          </tr>

                          <tr>
                              <td>Email</td>
                              <td>{{ data_get($userDetails,'email') }}</td>
                          </tr>


                      </tbody>
                    </table>
                  </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Billing Adress</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-sm">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"> <Strong>Billing Address</Strong></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ data_get($userDetails,'name') }}</td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td>{{ data_get($userDetails,'address') }}</td>
                        </tr>

                        <tr>
                            <td>City</td>
                            <td>{{ data_get($userDetails,'city') }}</td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>{{ data_get($userDetails,'state') }}</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{ data_get($userDetails,'country') }}</td>
                        </tr>
                        <tr>
                            <td>Pincode</td>
                            <td>{{ data_get($userDetails,'pincode') }}</td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>{{ data_get($userDetails,'mobile') }}</td>
                        </tr>

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Update Order Status</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-sm">
                    <thead>
                        @if (Session :: has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            {{ Session:: get('success_message') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        {{  Session::forget('success_message') }}
                        @endif
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"> <Strong>Update Order Status</Strong></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <form action="{{ url('admin/update-order-status') }}" method="post">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">
                                <select class="form-group" name="order_status" id="order_status" required="">
                                   @foreach ($orderStatuses as $status)
                                   <option value="{{ $status['name'] }}" @if (isset($orderDetails['order_status']) && $orderDetails['order_status'] == $status['name'])
                                   selected=""
                                   @endif >{{ $status['name'] }}</option>
                                   @endforeach
                                </select>&nbsp;<br>
                                <input style="width: 120px" type="text" name="courier_name" @if (empty($orderDetails['courier_name']))
                                id="courier_name" @endif placeholder="Courier Name"  value="{{ $orderDetails['courier_name'] }}">
                                <input style="width: 120px" type="text" name="tracking_number" @if (empty($orderDetails['tracking_number']))
                                id="tracking_number" @endif   placeholder="Tracking Number" value="{{ $orderDetails['tracking_number'] }}">

                                &nbsp; <button type="submit">Update</button>

                            </form>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                @foreach ($orderLog as $log)
                                <strong>{{   data_get($log,'order_status') }}</strong><br>
                                {{  date('F j, Y, g:i a',strtotime($log['created_at'] )) }}
                                <br>
                                <hr>
                                @endforeach
                            </td>
                        </tr>


                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Ordered Products</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Product Image</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Color</th>
                        <th>Product Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetails['order_products'] as $product)
                        <tr>
                        <td>
                            @php
                                $getProductImage = Product::getProductImage($product['product_id']);
                            @endphp
                            <a href="{{ url('product/'.$product['product_id']) }}">
                            <img style="width: 80px;" src="{{ asset('images/product_images/small/'.$getProductImage) }}" alt=""></a>
                        </td>
                        <td>{{ data_get($product,'product_code') }}</td>
                        <td>{{ data_get($product,'product_name') }}</td>

                        <td>{{ data_get($product,'product_size') }}</td>
                        <td>{{ data_get($product,'product_color') }}</td>
                        <td>{{ data_get($product,'product_qty') }}</td>
                         </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

@endsection
