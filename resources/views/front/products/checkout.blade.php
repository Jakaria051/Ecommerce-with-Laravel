
@php
use App\Product;
@endphp
@extends('layouts.front_layout.front_layout')
@section('content')
    <!--section start-->
    <section class="cart-section section-b-space">

        <form  id="checkoutForm" name="checkoutForm" action="{{ url('/checkout') }}" method="POST">
            @csrf

        <div class="container">

            <div class="row mt-5 mb-5">
            <div class="col-md-2 col-xl-2 col-lg-2"></div>

            <div class="col-lg-6 col-sm-12 col-md-8 col-lg-8 col-xl-8 col-xs-12">
             <table class="table table-bordered">
                 <tr><th><strong>Delivery Address</strong> | <a href="{{ url('add-edit-delivery-address') }}" >Add</a> </th>
                <td><a href="">Edit</a> | <a href="">Delete</a></td>
                </tr>
{{-- start Form --}}



                 @if (isset($deliveryAddressses) && !empty($deliveryAddressses))

               @foreach ($deliveryAddressses as $address)

                 <tr>
                     <td>
                         <div class="control-group" style="float: left;">
                            <input type="radio" id="address{{ $address['id'] }}"
                             name="address_id" value="{{ $address['id'] }}">
                         </div>
                         <div class="control-group">
                             <label class="control-level" for="">{{ $address['name'] }},
                                 {{ $address['address'] }},
                                 {{ $address['city'] }},
                                 {{ $address['state'] }},
                                 {{ $address['country'] }},
                             </label>
                         </div>
                     </td>
                 </tr>
                 @endforeach
                 @endif
             </table>

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




                    <table class="table cart-table table-responsive-xs">
                        <thead>
                            <tr class="table-head">
                                <th scope="col">image</th>
                                <th scope="col">product name</th>
                                <th scope="col">Unit price</th>
                                <th scope="col">quantity</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>

                        @php
                            $total_price = 0;
                        @endphp
                        @foreach ($userCartItems as $item)
                        @php
                            $attrPrice = Product::getDiscountAttrPrice($item['product_id'],$item['size']);
                        @endphp
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#"><img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" alt="product_img"></a>
                                </td>
                                <td><a href="#">{{ $item['product']['product_name'] }} &nbsp;({{ $item['product']['product_code'] }}) <br>
                                    Color: {{ $item['product']['product_color'] }} <br>
                                    Color: {{ data_get($item,'size') }} <br>
                                </a>
                                    <div class="mobile-cart-content row">
                                        <div class="col-xs-3">
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="text" name="quantity"  class="form-control input-number"
                                                        value="{{ data_get($item,'quantity') }}">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xs-3">
                                            @if (isset($attrPrice['product_price']) && !empty($attrPrice['product_price']))
                                            <h2 >${{ $attrPrice['product_price'] }}</h2>
                                            @endif
                                        </div>


                                    </div>
                                </td>
                                <td>
                                    @if (isset($attrPrice['product_price']) && !empty($attrPrice['product_price']))
                                    <h2 >${{ $attrPrice['product_price'] }}</h2>
                                    @endif

                                </td>
                                <td>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="number" name="quantity"  class="form-control input-number"
                                                value="{{ data_get($item,'quantity') }}" readonly></div>


                                    </div>

                                </td>
                                <td> @if (isset($attrPrice['discount']) && !empty($attrPrice['discount']))
                                    <h2 >${{ $attrPrice['discount'] }}</h2>
                                    @endif
                                </td>
                                <td>
                                    <h2 class="td-color">{{ $attrPrice['final_price'] * $item['quantity'] }}</h2>
                                </td>
                            </tr>
                        </tbody>
                        @php
                            $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']);
                        @endphp
                        @endforeach
                    </table>
                    <table class="table cart-table table-responsive-md">
                        <tfoot>
                            <tr>
                                <td>Sub total : &nbsp; </td>
                                <td>${{ $total_price }}</td>
                            </tr>
                            <tr>
                                <td>Coupon discounts: &nbsp;</td>
                                <td class="couponAmount">
                                    @if (Session::has('couponAmount'))
                                    ${{ Session::get('couponAmount') }}
                                    @else
                                    $0.0
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Grand Total: &nbsp;
                                </td>
                                <td>( <span>${{ $total_price }}</span> - <span class="couponAmount">${{ Session::get('couponAmount') }}</span> ) <br>
                                    <strong id="grandTotal">${{ $grand_total = $total_price - Session::get('couponAmount') }}
                                    @php
                                        Session::put('grand_total',$grand_total);
                                    @endphp
                                    </strong></td>

                            </tr>
                        </tfoot>
                    </table>

                    {{-- end ajax --}}

                    <form method="POST" action="javascript:void(0);" id="ApplyCoupon"  @if (Auth::check())
                    data-user="1"
                    @endif class="form-horizontal">
                        @csrf
                        <div class="control-group">
                            <label for="" class="control-level"><strong>Payment Methods</strong></label>
                            <div class="controls">
                              <span>
                                  <input type="radio" name="payment_gateway" id="COD" value="COD"><Strong>&nbsp; COD</Strong> &nbsp;&nbsp;
                                  <input type="radio" name="payment_gateway" id="Paypal" value="Paypal"><Strong>&nbsp; Paypal</Strong>
                              </span>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-6"><a href="{{ url('/cart') }}" class="btn btn-solid">Back to Cart</a></div>
                <div class="col-6"><button type="submit" href="#" class="btn btn-solid">Place Order</button></div>
            </div>
        </div>

    </form>


    </section>
    <!--section end-->

@endsection
