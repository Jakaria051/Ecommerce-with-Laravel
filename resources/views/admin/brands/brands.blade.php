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
              <li class="breadcrumb-item active">Brands</li>
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

                <h3 class="card-title">Brands</h3>
                <a href="{{ url('admin/add-edit-brand') }}" style="max-width: 150px; float: right; display:inline-block;"  class="btn btn-block btn-info">Add Brand</a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="brands" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($brands as $brand)
                  <tr>
                    <td>{{ $brand->id }}</td>
                  <td>{{ $brand->name }}</td>
                    <td>
                        &nbsp;&nbsp;
                        <a title="Edit Brand" href="{{ url('admin/add-edit-brand/'.$brand->id) }}"><i class="fas fa-edit"></i></a>
                        &nbsp;&nbsp;
                        <a title="Delete Brand" href="javascript:void(0)" class="confirmDelete" record="brand" recordId="{{ $brand->id }}"
                             @php /* href="{{ url('admin/delete-brand/'.$brand->id) }}" */ @endphp ><i class="fas fa-trash"></i></a>
                             &nbsp;&nbsp;
                             @if ($brand->status == 1)
                          <a class="updateBrandStatus" id="brand-{{ $brand->id }}"
                            brand_id="{{ $brand->id }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                        @else
                        <a class="updateBrandStatus" id="brand-{{ $brand->id }}"
                            brand_id="{{ $brand->id }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a>
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
