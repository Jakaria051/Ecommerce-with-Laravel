
{{-- product slider --}}
@php
    use App\Product;
@endphp
@extends('layouts.front_layout.front_layout')
@section('content')

    <section class="section-b-space parallax full-banner p-t-0 j-box ratio_square">
		            <img src="{{ asset('images/front_images/home-banner/6_1.png') }}" alt="" class="bg-img blur-up lazyload">
  <div class="title1  section-t-space title5">
       <h2 class="title-inner1">top collection</h2>
        <hr role="tournament6">
    </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="product-4 product-m no-arrow">
                        @foreach ($featuredItems as $featuredItem)
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="lable-block">
                                    <span class="lable3">new</span>
                                    <span class="lable4">on sale</span>
                                </div>
                                <div class="front">
                                    <a href="{{ url('product/'.$featuredItem['id']) }}">
                                        @php
                                            $product_image_path = 'images/product_images/small/'.$featuredItem['main_image'];
                                        @endphp
                                        @if (!empty($featuredItem['main_image']) && file_exists($product_image_path))
                                        <img
                                        src="{{ asset('images/product_images/small/'.$featuredItem['main_image']) }}"
                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                        @else
                                        <img
                                            src="{{ asset('images/product_images/small/no_image.png') }}"
                                            class="img-fluid blur-up lazyload bg-img" alt="">
                                        @endif
                                        </a>
                                </div>
                                <div class="cart-info cart-wrap">
                                    <button data-toggle="modal" data-target="#addtocart" title="Add to cart"><i
                                            class="ti-shopping-cart"></i></button>
                                    <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart"
                                            aria-hidden="true"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#quick-view" title="Quick View"><i
                                            class="ti-search" aria-hidden="true"></i></a>
                                    <a href="compare.html" title="Compare"><i class="ti-reload"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <a href="{{ url('product/'.$featuredItem['id']) }}">
                                    <h6>{{ data_get($featuredItem,'product_name') }}</h6>
                                </a>

                                @php
                                $discountPrice = Product::getDiscountPrice($featuredItem['id']);
                                @endphp
                            <h4>
                                @if ($discountPrice >0)
                                <del>${{ data_get($featuredItem,'product_price') }}</del>
                                 ${{ $discountPrice }}
                                @else
                                ${{ data_get($featuredItem,'product_price') }}
                                @endif
                            </h4>

                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product slider end -->
	    <!-- Paragraph-->
    <div class="title1  section-t-space title5">
       <h2 class="title-inner1">Our Services</h2>
        <hr role="tournament6">
    </div>
    <!-- Paragraph end -->

	    <!--section start-->
    <section class="collection section-b-space ratio_square ">

        <div class="container">
            <div class="row partition-collection">
                <div class="col-lg-3 col-md-6">
                    <div class="collection-block">
                        <div><img src="{{ asset('images/front_images/collection/2.jpg') }}" class="img-fluid blur-up lazyload bg-img"
                                alt=""></div>
                        <div class="collection-content">
                            <h3>Sampling / Prototype
</h3>
                            <p>Working with final year grad students to renowned designers we can help you create any piece you can imagine.
</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="collection-block">
                        <div><img src="{{ asset('images/front_images/collection/1.jpg') }}" class="img-fluid blur-up lazyload bg-img"
                                alt=""></div>
                        <div class="collection-content">
                            <h3>Bespoke </h3>
                            <p>Come sit down with us and let us help you make the most unique skillful and master crafted garment you will ever wear.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="collection-block">
                        <div><img src="{{ asset('images/front_images/collection/2.jpg') }}" class="img-fluid blur-up lazyload bg-img"
                                alt=""></div>
                        <div class="collection-content">

                            <h3>Production
</h3>
                            <p>With revised patterns and completed designs, from cutting adding trims to making we control all aspects of production to give you a piece of mind.
</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="collection-block">
                        <div><img src="{{ asset('images/front_images/collection/1.jpg') }}" class="img-fluid blur-up lazyload bg-img"
                                alt=""></div>
                        <div class="collection-content">
                            <h3>Wholesale
</h3>

                            <p>Have a store but no designs? Let us show you our meticulously created range, tailored solely for those who want to diverse and expand their range.
</p>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          </div>
    </section>
    <!--Section ends-->

    <!-- Tab product -->
    <div class="title1 section-t-space title5">
        <h4>exclusive products</h4>
        <h2 class="title-inner1">special products</h2>
        <hr role="tournament6">
    </div>
    <section class="p-t-0 j-box ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="theme-tab">

                        <div class="tab-content-cls">
                            <div id="tab-4" class="tab-content active default">
                                <div class=" no-slider row">

                                    @foreach ($newProducts as $newProduct)
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="{{ url('product/'.$newProduct['id']) }}">

                                                    @php
                                                        $product_image_path = 'images/product_images/small/'.$newProduct['main_image'];
                                                    @endphp
                                                    @if (!empty($newProduct['main_image']) && file_exists($product_image_path))
                                                    <img
                                                    src="{{ asset('images/product_images/small/'.$newProduct['main_image']) }}"
                                                    class="img-fluid blur-up lazyload bg-img" alt="">
                                                    @else
                                                    <img
                                                        src="{{ asset('images/product_images/small/no_image.png') }}"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                    @endif

                                                    </a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button data-toggle="modal" data-target="#addtocart"
                                                    title="Add to cart"><i class="ti-shopping-cart"></i></button>
                                                <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart"
                                                        aria-hidden="true"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#quick-view"
                                                    title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                <a href="compare.html" title="Compare"><i class="ti-reload"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <a href="{{ url('product/'.$newProduct['id']) }}">
                                                <h6>{{ data_get($newProduct,'product_name') }}</h6>
                                                <p>{{ data_get($newProduct,'product_code') }} ({{ data_get($newProduct,'product_color') }})</p>
                                            </a>

                                            @php
                                            $discountPrice = Product::getDiscountPrice($newProduct['id']);
                                            @endphp
                                            <h4>
                                                @if ($discountPrice >0)
                                                <del>${{ data_get($newProduct,'product_price') }}</del>
                                                ${{ $discountPrice }}
                                                @else
                                                ${{ data_get($newProduct,'product_price') }}
                                                @endif
                                            </h4>

                                        </div>
                                    </div>

                                    @endforeach

                                </div>
                            </div>
                            {{-- <div id="tab-5" class="tab-content">
                                <div class=" no-slider row">

                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Tab product end -->
@endsection
