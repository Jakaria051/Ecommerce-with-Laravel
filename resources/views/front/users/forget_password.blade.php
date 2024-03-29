@extends('layouts.front_layout.front_layout')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>customer's login / register / Forgot Password</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">login-register</li>
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
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="login-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Forget Password</h3>
                    <div class="theme-card">


                        <h3 class="title-font">Enter your mail to get the new password</h3>
                        <form id="forgotPasswordForm" class="theme-form" action="{{ route('user.forgot.password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required="">
                            </div>
                            <button class="btn" type="submit">Create Your Account</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3>Already Registered?</h3>
                    <div class="theme-card authentication-right">
                        <h6 class="title-font">Login Here</h6>
                        <form class="theme-form" id="loginForm" action="{{ route('login.user') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" >
                            </div>
                            <div class="form-group">
                                <label for="review">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Enter your password" >
                            </div><button class="btn" type="submit">Login</button>

                            <a href="{{ route('user.forgot.password') }}" class="btn btn-solid">Forgot Password</a>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->

@endsection
