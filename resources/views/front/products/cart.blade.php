
@extends('layouts.front_layout.front_layout')
@section('content')
    <!--section start-->
    <section class="cart-section section-b-space">
        <div class="container">

            <div class="row mt-5 mb-5">
            <div class="col-md-2 col-xl-2 col-lg-2"></div>
            <div class="col-lg-6 col-sm-12 col-md-8 col-lg-8 col-xl-8 col-xs-12">
                <div class="checkout-title">
                    <h3>I'M Already Registered</h3>
                </div>
                <div class="field-label">Username</div>
                        <input type="text" name="field-name" value="" placeholder="">
                        <div class="field-label">Password</div>
                        <input type="text" name="field-name" value="" placeholder=""> <br> <br>


                    <button>SignIN</button>Or<button>Registration</button> <br>
                    <a href="">Forget Password?</a>

            </div>
            <div class="col-md-2 col-xl-2 col-lg-2"></div>
            </div>

            <div class="row">
                <div class="col-sm-12">

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

                    {{-- start ajax --}}

                    <div id="AppendCartItems">
                        @include('front.products.cart_item')
                    </div>
                    {{-- end ajax --}}


                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-6"><a href="#" class="btn btn-solid">continue shopping</a></div>
                <div class="col-6"><a href="#" class="btn btn-solid">check out</a></div>
            </div>
        </div>
    </section>
    <!--section end-->

@endsection
