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
          <div class="col-12">

            @if (Session :: has('success_message'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ Session:: get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Orders</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="products" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Ordered Product</th>
                    <th>Order Amount</th>
                    <th>Order Status</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $order)

                  <tr>
                    <td>{{ data_get($order,'id') }}</td>
                    <td>{{  date('d-m-Y', strtotime(data_get($order,'created_at'))) }}</td>
                    <td>{{ data_get($order,'name') }}</td>
                    <td>{{ data_get($order,'email') }}</td>
                    <td>
                        @foreach ($order['order_products'] as $pro)
                        {{ data_get($pro,'product_code') }} ({{ data_get($pro,'product_qty') }}) <br>
                        @endforeach
                       </td>

                       <td>{{ data_get($order,'grand_total') }}</td>
                       <td>{{ data_get($order,'order_status') }}</td>
                       <td>{{ data_get($order,'payment_method') }}</td>


                    <td>
                    <a title="VIew Order Details" href="{{ url('admin/orders/'.$order['id']) }}"><i class="fas fa-file"></i></a>
                    &nbsp;&nbsp;
                    @if ($order['order_status'] == "Shipped" || $order['order_status'] == "Delivered")
                    <a title="VIew Order Details" href="{{ url('admin/view-order-invoice/'.$order['id']) }}"><i class="fas fa-print"></i></a>

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
