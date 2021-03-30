
@php
use App\Product;
use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.front_layout.front_layout')
@section('content')
    <!--section start-->

     <div class="row">

        <div class="container">

            <h3>Orders</h3>
            <hr>

                <div class="span4" >
                    <table class="table table-striped table bordered">
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


                    </table>
                </div>



                <div class="span4" >
                    <table class="table table-striped table bordered">
                        <tr>
                            <td colspan="2"> <Strong>Delivery Address</Strong></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ data_get($orderDetails,'name') }}</td>
                        </tr>

                        <tr>
                            <td>Address</td>
                            <td>${{ data_get($orderDetails,'address') }}</td>
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

                    </table>
                </div>



            <hr>

                <div class="span8" align="center">
                    <table class="table table-striped table bordered">
                        <tr>
                            <th>Product Image</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Product Color</th>
                            <th>Product Qty</th>

                        </tr>
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
                    </table>
                </div>



        </div>

    </div>


@endsection

