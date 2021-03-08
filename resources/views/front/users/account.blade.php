@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>My Account</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">My Account</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
        @if (Session :: has('success_message'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ Session:: get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (Session :: has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            {{ Session:: get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger" style="margin-top: 5px;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="login-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Contact details</h3>
                    <div class="theme-card">


                        <h6 class="title-font">My Account</h6>
                        <form id="accountForm" class="theme-form" action="{{ url('/account') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ data_get($userDetails,'name') }}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{ data_get($userDetails,'address') }}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City " value="{{ data_get($userDetails,'city') }}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">State</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" value="{{ data_get($userDetails,'state') }}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Country</label>
                                <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country " value="{{ data_get($userDetails,'country') }}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Pincode</label>
                                <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode " value="{{ data_get($userDetails,'pincode') }}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile "value="{{ data_get($userDetails,'mobile') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                            </div>

                            <button class="btn" type="submit">Update</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3>Update Password</h3>
                    <div class="theme-card authentication-right">
                        <form class="theme-form" id="passwordForm" action="{{ url('/update-password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="review">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Enter your password" >
                                    <label for="review">New Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Enter your password" >
                                        <label for="review">Confirm Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Enter your password" >
                            </div><button class="btn" type="submit">Update Password</button>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->

@endsection
