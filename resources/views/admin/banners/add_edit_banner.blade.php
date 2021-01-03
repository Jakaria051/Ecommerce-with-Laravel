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
              <li class="breadcrumb-item active">Banners</li>
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
      <form @if (empty($bannerdata['id'])) action="{{ url('admin/add-edit-banner') }}"
      @else action="{{ url('admin/add-edit-banner/'.$bannerdata['id']) }}" @endif  name="bannerForm" id="bannerForm"
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
                    <label for="title">Banner Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Banner name"
                    @if (!empty($bannerdata['title']))
                    value="{{ $bannerdata['title'] }}"
                    @else
                   value="{{ old('title') }}"
                    @endif>
                  </div>

                <div class="form-group">
                    <label for="link">Banner Link</label>
                    <input type="text" class="form-control" name="link" id="link" placeholder="Enter Banner Link"
                    @if (!empty($bannerdata['link']))
                    value="{{ $bannerdata['link'] }}"
                    @else
                   value="{{ old('link') }}"
                    @endif>
                  </div>

              </div>


              <div class="col-md-6">
                <div class="form-group">
                    <label for="alt">Banner Alternative Text</label>
                    <input type="text" class="form-control" name="alt" id="alt" placeholder="Enter Banner Color"
                    @if (!empty($bannerdata['alt']))
                    value="{{ $bannerdata['alt'] }}"
                    @else
                   value="{{ old('alt') }}"
                    @endif>
                  </div>


                  <div class="form-group">
                    <label for="image">Banner Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                    <div>Recommended Image Size:(1140px,Heght:480px)</div>

                    @if (!empty($bannerdata['image']))
                    <div style="height: 100px;">
                    <img style="width: 70px;margin-top:7px;" src="{{ asset('images/banner_images/'.$bannerdata['image']) }}" alt="image-potion">
                    &nbsp;
                    <a class="confirmDelete" href="javascript:void(0)" record="banner-image" recordId="{{ $bannerdata['id'] }}" @php /*href="{{ url('admin/delete-category-image/'.$categorydata['id']) }}" */ @endphp >Delete Image</a>
                    </div>
                    @endif
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

