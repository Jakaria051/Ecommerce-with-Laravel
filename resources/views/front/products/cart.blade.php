@php
    use App\Product;
@endphp
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


                                        <div class="col-xs-3">
                                            <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a>
                                            </h2>
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
                                            <input type="number" name="quantity" id="appendInputButtons" class="form-control input-number"
                                                value="{{ data_get($item,'quantity') }}">
                                                <button><a href="#" class="icon"><i class="ti-minus"></i></a></button>
                                                <button> <a href="#" class="icon"><i class="ti-plus"></i></a></button>
                                                    <button ><a href="#" class="icon"><i class="ti-close"></i></a></button>
                                            </div>


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
                                <td>total price :</td>
                                <td>
                                    <h2>${{ $total_price }}</h2> <br>
                                    Grand Total : ${{ $total_price }}- $0 = Total
                                </td>
                            </tr>
                        </tfoot>
                    </table>
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
