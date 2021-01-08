@extends('layouts.front_layout.front_layout')
@section('content')

 <!-- section start -->
 <section class="section-b-space ratio_asos">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 collection-filter">
                    <!-- side-bar colleps block stat -->
                    <div class="collection-filter-block">
                        <!-- brand filter start -->
                        <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"
                                    aria-hidden="true"></i> back</span></div>
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Type</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="zara">
                                        <label class="custom-control-label" for="zara">Coats</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="vera-moda">
                                        <label class="custom-control-label" for="vera-moda">Jackets</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="forever-21">
                                        <label class="custom-control-label" for="forever-21">Gilets</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="roadster">
                                        <label class="custom-control-label" for="roadster">Leather</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="only">
                                        <label class="custom-control-label" for="only">others</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="collection-collapse-block border-0 open">
                            <h3 class="collapse-block-title">size</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="hundred">
                                        <label class="custom-control-label" for="hundred">s</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="twohundred">
                                        <label class="custom-control-label" for="twohundred">m</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="threehundred">
                                        <label class="custom-control-label" for="threehundred">l</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="fourhundred">
                                        <label class="custom-control-label" for="fourhundred">xl</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- price filter start here -->
                        <div class="collection-collapse-block border-0 open">
                            <h3 class="collapse-block-title">price</h3>
                            <div class="collection-collapse-block-content">
                                <div class="wrapper mt-3">
                                    <div class="range-slider">
                                        <input type="text" class="js-range-slider" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- silde-bar colleps block end here -->
                    <!-- side-bar single product slider start -->
                    <div class="theme-card">
                        <h5 class="title-border">new product</h5>
                        <div class="offer-slider slide-1">
                            <div>
                                <div class="media">
                                    <a href="#"><img class="img-fluid blur-up lazyload" src="../assets/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                        <a href="product-page(no-sidebar).html">
                                            <h6>Slim Fit Cotton Shirt</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="#"><img class="img-fluid blur-up lazyload" src="../assets/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                        <a href="product-page(no-sidebar).html">
                                            <h6>Slim Fit Cotton Shirt</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="#"><img class="img-fluid blur-up lazyload" src="../assets/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                        <a href="product-page(no-sidebar).html">
                                            <h6>Slim Fit Cotton Shirt</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="media">
                                    <a href="#"><img class="img-fluid blur-up lazyload" src="../assets/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                        <a href="product-page(no-sidebar).html">
                                            <h6>Slim Fit Cotton Shirt</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="#"><img class="img-fluid blur-up lazyload" src="../assets/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                        <a href="product-page(no-sidebar).html">
                                            <h6>Slim Fit Cotton Shirt</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="#"><img class="img-fluid blur-up lazyload" src="../assets/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                        <a href="product-page(no-sidebar).html">
                                            <h6>Slim Fit Cotton Shirt</h6>
                                        </a>
                                        <h4>$500.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- side-bar single product slider end -->
                    <!-- side-bar banner start here -->
                    <div class="collection-sidebar-banner">
                        <a href="#"><img src="../assets/images/side-banner.png" class="img-fluid blur-up lazyload" alt=""></a>
                    </div>
                    <!-- side-bar banner end here -->
                </div>
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="top-banner-wrapper">
                                    <a href="#">
                                        <img src="../assets/images/mega-menu/2.jpg" class="img-fluid blur-up lazyload" alt="">

                                    </a>
                                    <div class="top-banner-content small-section">
                                        <h4>{{ $categoryDetails['catDetails']['category_name'] }} ( {{ count($categoryProducts) }} )</h4>

                                        <p>{{ $categoryDetails['catDetails']['description'] }}</p>
                                    </div>
                                    {{-- breadcrumb --}}
                                    <ul class="breadcrumb">
                                        <li><a href="{{ url('/')}}">Home</a><span class="divider">/</span></li>
                                        <li class="active">@php
                                            echo $categoryDetails['breadcrumbs'];
                                        @endphp</li>
                                    </ul>
                                </div>
                                <div class="collection-product-wrapper">
                                    <div class="product-top-filter">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="filter-main-btn"><span class="filter-btn btn btn-theme"><i class="fa fa-filter"
                                                            aria-hidden="true"></i> Filter</span></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="product-filter-content">
                                                    <div class="search-count">
                                                        <h5>Showing Products 1-24 of 10 Result</h5>
                                                    </div>
                                                    <div class="collection-view">
                                                        <ul>
                                                            <li><i class="fa fa-th grid-layout-view"></i></li>
                                                            <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                        </ul>
                                                    </div>
                                                    <div class="collection-grid-view">
                                                        <ul>
                                                            <li><img src="../assets/images/icon/2.png" alt="" class="product-2-layout-view"></li>
                                                            <li><img src="../assets/images/icon/3.png" alt="" class="product-3-layout-view"></li>
                                                            <li><img src="../assets/images/icon/4.png" alt="" class="product-4-layout-view"></li>
                                                            <li><img src="../assets/images/icon/6.png" alt="" class="product-6-layout-view"></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-page-per-view">
                                                        <select>
                                                            <option value="High to low">24 Products Par Page
                                                            </option>
                                                            <option value="Low to High">50 Products Par Page
                                                            </option>
                                                            <option value="Low to High">100 Products Par Page
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="product-page-filter">
                                                        <select>
                                                            <option value="High to low">Sorting items</option>
                                                            <option value="Low to High">50 Products</option>
                                                            <option value="Low to High">100 Products</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- All Products view --}}


                                    <div class="product-wrapper-grid">
                                        <div class="row margin-res">


                                            @foreach ($categoryProducts as $product)

                                            <div class="col-xl-3 col-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#">
                                                                @php
                                                                $product_image_path = 'images/product_images/small/'.$product['main_image'];
                                                                @endphp
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
                                                        <a href="product-page(no-sidebar).html">
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
                                    </div>

                                {{-- end Products view --}}

                                    <div class="product-pagination">
                                        <div class="theme-paggination-block">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6 col-sm-12">
                                                    <nav aria-label="Page navigation">
                                                        <ul class="pagination">
                                                            <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span
                                                                        aria-hidden="true"><i
                                                                            class="fa fa-chevron-left"
                                                                            aria-hidden="true"></i></span> <span
                                                                        class="sr-only">Previous</span></a></li>
                                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true"><i
                                                                            class="fa fa-chevron-right"
                                                                            aria-hidden="true"></i></span> <span
                                                                        class="sr-only">Next</span></a></li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                                <div class="col-xl-6 col-md-6 col-sm-12">
                                                    <div class="product-search-count-bottom">
                                                        <h5>Showing Products 1-24 of 10 Result</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section End -->

@endsection
