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

           @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ Session:: get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif


        <!-- SELECT2 EXAMPLE -->
      <form @if (empty($brand['id'])) action="{{ url('admin/add-edit-brand') }}"
      @else action="{{ url('admin/add-edit-brand/'.$brand['id']) }}" @endif  name="brandForm" id="brandForm"
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
              <div class="col-md-6">
                <div class="form-group">
                    <label for="brand_name">Brand Name</label>
                    <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Brand name"
                    @if (!empty($brand['name']))
                    value="{{ $brand['name'] }}"
                    @else
                   value="{{ old('brand_name') }}"
                    @endif>
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

