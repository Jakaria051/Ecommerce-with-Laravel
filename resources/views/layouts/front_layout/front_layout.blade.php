<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="City Sheepskin has been manufacturing high quality sheepskin jackets and coats for both men and women for over 25 years with our specially picked expert team, we supplied and still supply some of the biggest fashion houses all over the world, but still our designing and manufacturing process all happens in house here in our London Shoreditch factory and showroom, so from start to end we have complete control over all aspects of our garments ensuring superior quality garments">
    <meta name="keywords" content="City Sheepskin, Sheepskin, Shearling garments in London, Leather Jackets, Shearling, Best jackets, Original sheepskin, Expensive, Luxurious">
    <meta name="author" content="City Sheepskin">
    <link rel="icon" href="{{ asset('images/front_images/ficon.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('images/front_images/ficon.png') }}" type="image/x-icon" />
    <title>City Sheep skin</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/front_css/fontawesome.css') }}">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{ url('css/front_css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/front_css/slick-theme.css') }}">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/front_css/animate.css') }}">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/front_css/themify-icons.css') }}">
  <!-- Price range icon -->
  
    <link rel="stylesheet" type="text/css" href="{{ url('css/front_css/price-range.css') }}">
    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/front_css/bootstrap.css') }}">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/front_css/color16.css') }}" media="screen" id="color">


</head>

<body>

 @include('layouts.front_layout.front_header')
<!-- header end -->

{{-- slider --}}

   @if (isset($page_name) && $page_name == "index")
    <!-- Home slider -->
    <section class="p-0 height-100">
        <div class="slide-1 home-slider">
            <div>
                <div class="home text-center bg-position p-right">
                    <img src="{{ asset('images/front_images/home-banner/1_1.png') }}" alt="" class="bg-img blur-up lazyload">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="slider-contain">
                                    <div>
                                        <h4 style="color:black;">luxurious sheepskin
and shearling garments</h4>
                                        <h1>Our collection</h1>
                                        <a href="#" class="btn btn-solid">shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="home text-center ">
                    <img src="{{ asset('images/front_images/home-banner/3_1.png') }}" alt="" class="bg-img blur-up lazyload">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="slider-contain">
                                    <div>
                                        <h4> Fine quality real sheepskin and shearling </h4>
                                        <h1>Sale with Design</h1>
                                        <a href="#" class="btn btn-solid">shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
    <!-- Home slider end -->

@endif
{{--end slider --}}



    <!-- Paragraph-->

    <!-- Paragraph end -->


    <!-- Product slider -->

    @yield('content')

  @include('layouts.front_layout.front_footer')
    <!-- footer end -->

    <!-- Add to cart modal popup modal start-->
    <div class="modal fade bd-example-modal-lg theme-modal cart-modal" id="addtocart" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal1">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="modal-bg addtocart">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="media">
                                        <a href="#">
                                            <img class="img-fluid blur-up lazyload pro-img"
                                                src="{{ asset('images/front_images/fashion/product/43.jpg') }}" alt="">
                                        </a>
                                        <div class="media-body align-self-center text-center">
                                            <a href="#">
                                                <h6>
                                                    <i class="fa fa-check"></i>Item
                                                    <span>men full sleeves</span>
                                                    <span> successfully added to your Cart</span>
                                                </h6>
                                            </a>
                                            <div class="buttons">
                                                <a href="#" class="view-cart btn btn-solid">Your cart</a>
                                                <a href="#" class="checkout btn btn-solid">Check out</a>
                                                <a href="#" class="continue btn btn-solid">Continue shopping</a>
                                            </div>

                                            <div class="upsell_payment">
                                                <img src="{{ asset('images/front_images/payment_cart.png') }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-section">
                                        <div class="col-12 product-upsell text-center">
                                            <h4>Customers who bought this item also.</h4>
                                        </div>
                                        <div class="row" id="upsell_product">
                                            <div class="product-box col-sm-3 col-6">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#">
                                                            <img src="{{ asset('images/front_images/fashion/product/1.jpg') }}"
                                                                class="img-fluid blur-up lazyload mb-1"
                                                                alt="cotton top">
                                                        </a>
                                                    </div>
                                                    <div class="product-detail">
                                                        <h6><a href="#"><span>cotton top</span></a></h6>
                                                        <h4><span>$25</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-box col-sm-3 col-6">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#">
                                                            <img src="{{ asset('images/front_images/fashion/product/34.jpg') }}"
                                                                class="img-fluid blur-up lazyload mb-1"
                                                                alt="cotton top">
                                                        </a>
                                                    </div>
                                                    <div class="product-detail">
                                                        <h6><a href="#"><span>cotton top</span></a></h6>
                                                        <h4><span>$25</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-box col-sm-3 col-6">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#">
                                                            <img src="{{ asset('images/front_images/fashion/product/13.jpg') }}"
                                                                class="img-fluid blur-up lazyload mb-1"
                                                                alt="cotton top">
                                                        </a>
                                                    </div>
                                                    <div class="product-detail">
                                                        <h6><a href="#"><span>cotton top</span></a></h6>
                                                        <h4><span>$25</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-box col-sm-3 col-6">
                                                <div class="img-wrapper">
                                                    <div class="front">
                                                        <a href="#">
                                                            <img src="{{ asset('images/front_images/fashion/product/19.jpg') }}"
                                                                class="img-fluid blur-up lazyload mb-1"
                                                                alt="cotton top">
                                                        </a>
                                                    </div>
                                                    <div class="product-detail">
                                                        <h6><a href="#"><span>cotton top</span></a></h6>
                                                        <h4><span>$25</span></h4>
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
    <!-- Add to cart modal popup end-->

    <!-- tap to top -->
    <div class="tap-top">
        <div>
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <!-- tap to top end -->


    <!-- latest jquery-->
    <script src="{{ url('js/front_js/jquery-3.3.1.min.js') }}"></script>

    <!-- fly cart ui jquery-->
    <script src="{{ url('js/front_js/jquery-ui.min.js') }}"></script>

    <!-- popper js-->
    <script src="{{ url('js/front_js/popper.min.js') }}"></script>

    <!-- slick js-->
    <script src="{{ url('js/front_js/slick.js') }}"></script>

    <!-- menu js-->
    <script src="{{ url('js/front_js/menu.js') }}"></script>

    <!-- lazyload js-->
    <script src="{{ url('js/front_js/lazysizes.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ url('js/front_js/bootstrap.js') }}"></script>

    <!-- Bootstrap Notification js-->
    <script src="{{ url('js/front_js/bootstrap-notify.min.js') }}"></script>

    <!-- Theme js-->
    <script src="{{ url('js/front_js/script.js') }}"></script>



    <script>
        $(window).on('load', function () {
            setTimeout(function () {
                $('#exampleModal').modal('show');
            }, 2500);
        });
        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
    </script>

</body>
</html>
