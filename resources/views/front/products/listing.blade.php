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
                            <h3 class="collapse-block-title">Fabric</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">

                                    @foreach ($fabricArray as $fabric)
                                    <input class="fabric" type="checkbox" style="margin-top: -3px;" name="fabric[]" value="{{ $fabric }}" id="{{ $fabric }}">&nbsp;&nbsp;{{ $fabric }}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Sleeve</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    @foreach ($sleeveArray as $sleeve)
                                    <input class="sleeve" type="checkbox" style="margin-top: -3px;" name="sleeve[]" value="{{ $sleeve }}" id="{{ $sleeve }}">&nbsp;&nbsp;{{ $sleeve }}<br>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Pattern</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    @foreach ($PatternArray as $pattern)
                                    <input class="pattern" type="checkbox" style="margin-top: -3px;" name="pattern[]" value="{{ $pattern }}" id="{{ $pattern }}">&nbsp;&nbsp;{{ $pattern }}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Fit</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    @foreach ($fitArray as $fit)
                                    <input class="fit" type="checkbox" style="margin-top: -3px;" name="fit[]" value="{{ $fit }}" id="{{ $fit }}">&nbsp;&nbsp;{{ $fit }}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Occation</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    @foreach ($occasionArray as $occation)
                                    <input class="occation" type="checkbox" style="margin-top: -3px;" name="occation[]" value="{{ $occation }}" id="{{ $occation }}">&nbsp;&nbsp;{{ $occation }}<br>
                                    @endforeach
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
                                     {{-- breadcrumb --}}

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
                                                            <option value="High to low">Sort By
                                                            </option>
                                                        </select>
                                                    </div>
                                                   <form name="sortProducts" id="sortProducts" class="product-page-filter">
                                                   <input type="hidden" name="url" id="url" value="{{ $url }}">
                                                    <div class="">
                                                        <select name="sort" id="sort">
                                                            <option value="">Select</option>
                                                            <option value="product_latest"
                                                            @if(isset($_GET['sort']) && $_GET['sort'] == "product_latest") selected="" @endif>Latest Product</option>
                                                            <option value="product_name_a_z"
                                                            @if(isset($_GET['sort']) && $_GET['sort'] == "product_name_a_z") selected="" @endif
                                                            >Product name A-Z</option>
                                                            <option value="product_name_z_a"
                                                            @if(isset($_GET['sort']) && $_GET['sort'] == "product_name_z_a") selected="" @endif
                                                            >Product name Z-A</option>
                                                            <option value="price_lowest"
                                                            @if(isset($_GET['sort']) && $_GET['sort'] == "price_lowest") selected="" @endif
                                                            >Lowest Price first</option>
                                                            <option value="price_highest"
                                                            @if(isset($_GET['sort']) && $_GET['sort'] == "price_highest") selected="" @endif
                                                            >Highest Price first</option>
                                                        </select>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- All Products view --}}


                                    <div class="product-wrapper-grid filter_products">
                                       @include('front.products.ajax_product_listing')
                                    </div>

                                {{-- end Products view --}}

                                    <div class="product-pagination">
                                        @if (isset($_GET['sort']) && !empty($_GET['sort']))
                                        {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                                        @else
                                        {{ $categoryProducts->links() }}
                                        @endif


                                        {{-- <div class="theme-paggination-block">
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
                                        </div> --}}


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
