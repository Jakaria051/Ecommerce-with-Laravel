
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
                  <h3 class="card-title">Simple Full Width Table</h3>

                  <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th>Progress</th>
                        <th style="width: 40px">Label</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-danger">55%</span></td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-warning">70%</span></td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-primary" style="width: 30%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-primary">30%</span></td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-success" style="width: 90%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-success">90%</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Striped Full Width Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th>Progress</th>
                        <th style="width: 40px">Label</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-danger">55%</span></td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-warning">70%</span></td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-primary" style="width: 30%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-primary">30%</span></td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-success" style="width: 90%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-success">90%</span></td>
                      </tr>
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
