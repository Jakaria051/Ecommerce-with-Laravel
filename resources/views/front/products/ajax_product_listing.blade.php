  {{-- All Products view --}}

    <div class="row margin-res">


        @foreach ($categoryProducts as $product)

        <div class="col-xl-3 col-6 col-grid-box">
            <div class="product-box">
                <div class="img-wrapper">
                    <div class="front">
                        <a href="{{ url('product/'.$product['id']) }}">
                            @if (isset($product['main_image']))
                                @php
                                $product_image_path = 'images/product_images/small/'.$product['main_image'];
                                @endphp
                            @else
                                @php
                                $product_image_path = '';
                                @endphp
                            @endif

                            @if (!empty($product['main_image']) && file_exists($product_image_path))
                            <img src="{{ asset('images/product_images/small/'.$product['main_image']) }}"
                                class="img-fluid blur-up lazyload bg-img" alt="">
                            @else
                            <img src="{{ asset('images/product_images/small/no_image.png') }}" class="img-fluid blur-up lazyload bg-img" alt="">
                            @endif
                        </a>
                    </div>
                    {{-- <div class="back">
                        <a href="#"><img src="../assets/images/pro3/28.jpg" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                    </div> --}}
                    <div class="cart-info cart-wrap">
                        <button data-toggle="modal" data-target="#addtocart" title="Add to cart"><i
                                class="ti-shopping-cart"></i></button> <a href="javascript:void(0)" title="Add to Wishlist"><i
                                class="ti-heart" aria-hidden="true"></i></a> <a href="#" data-toggle="modal" data-target="#quick-view" title="Quick View"><i
                                class="ti-search" aria-hidden="true"></i></a> <a href="compare.html" title="Compare"><i
                                class="ti-reload" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="product-detail">
                    <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    </div>
                    <a href="{{ url('product/'.$product['id']) }}">
                        <h6>{{ data_get($product,'product_name') }}</h6>
                    </a>
                    <h6>
                        {{ $product['brand']['name'] }}
                    </h6>
                    <h4>${{ data_get($product,'product_price') }}</h4>
                    <ul class="color-variant">
                        <li class="bg-light0"></li>
                        <li class="bg-light1"></li>
                        <li class="bg-light2"></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach


    </div>


{{-- end Products view --}}
