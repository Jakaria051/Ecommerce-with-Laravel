
@php
use App\Product;
use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.front_layout.front_layout')
@section('content')
    <!--section start-->
    <section class="cart-section section-b-space">

        <div class="container">

            <div class="row mt-5 mb-5">
            <div class="col-md-2 col-xl-2 col-lg-2"></div>

            <div class="col-lg-6 col-sm-12 col-md-8 col-lg-8 col-xl-8 col-xs-12">
             <table class="table table-bordered">
                 <tr><th><strong>Thanks </strong> </th>

                </tr>
             </table>
            </div>
            </div>

            <div align="center">
                <h3>Your order have been placed successfully. </h3> <br>
                <p>Your order number is {{ Session::get('order_id') }} and total cost $ {{ Session::get('grand_total') }}</p>
            </div>
        </div>



    </section>
    <!--section end-->

@endsection


@php
     Session::forget('order_id');
      Session::forget('grand_total');
@endphp
