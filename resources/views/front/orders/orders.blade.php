
@php
use App\Product;
use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.front_layout.front_layout')
@section('content')
    <!--section start-->
    <section class="cart-section section-b-space">
        <div class="container">
        <div class="span9" align="center">
            <h3>Orders</h3>
            <hr>
            <div class="row" >
                <div class="span8" align="center">
                    <table class="table table-striped table bordered">
                        <tr>
                            <th>Order ID</th>
                            <th>Order Products</th>
                            <th>Payment Method</th>
                            <th>Grand Total</th>
                            <th>Crated On</th>
                            <th></th>
                        </tr>

                        @foreach ($orders as $order)
                        <tr>
                        <td><a style="text-decoration: underline;" href="{{ url('orders/'.$order['id']) }}"></a>#{{ data_get($order,'id') }}</td>
                        <td>
                            @foreach ($order['order_products'] as $pro)
                            {{ data_get($pro,'product_code') }} <br>
                            @endforeach
                        </td>
                        <td>{{ data_get($order,'payment_method') }}</td>
                        <td>{{ data_get($order,'grand_total') }}</td>
                        <td>{{  date('d-m-Y', strtotime(data_get($order,'created_at'))) }}</td>
                        <td><a style="text-decoration: underline;" href="{{ url('orders/'.$order['id']) }}">View Details</a></td>
                    </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>

    </div>

    </section>
    <!--section end-->

@endsection

