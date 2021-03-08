@php
   use App\Section;
    $sections= Section::sections();
  //  echo "<pre>"; print_r($sections); die;
@endphp

   <!-- header start -->
   <header>
    <div class="mobile-fix-option"></div>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact">
                        <ul>
                            <li>Welcome to City Sheep Skin</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>Call Us: 020 7739 5130</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-right">
                    <ul class="header-dropdown">
                        <li class="mobile-wishlist"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                        </li>
                        @if (Auth::check())
                        <li class="onhover-dropdown mobile-account">
                            <i class="fa fa-user" aria-hidden="true"></i> My Account
                            <ul class="onhover-show-div">
                                <li><a href="{{ url('account') }}" data-lng="es">My Account</a></li>
                                <li><a href="{{ url('logout') }}" data-lng="es">Logout</a></li>
                            </ul>
                        </li>
                        @else
                        <li class="onhover-dropdown mobile-account">
                            <i class="fa fa-user" aria-hidden="true"></i> My Account
                            <ul class="onhover-show-div">
                                <li><a href="{{ url('login-register') }}" data-lng="en">Login/Register</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="navbar">
                            <a href="javascript:void(0)" onclick="openNav()">
                                <div class="bar-style"><i class="fa fa-bars sidebar-bar" aria-hidden="true"></i>
                                </div>
                            </a>

                        </div>
                        <div class="brand-logo"><a href="{{ url('/') }}"><img src="{{ asset('images/front_images/logo1.png') }}"
                                    class="img-fluid blur-up lazyload" alt=""></a></div>
                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li>
                                        <div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2"
                                                aria-hidden="true"></i></div>
                                    </li>
                                     <li>
                                        <a href="{{ url('/') }}">Home</a></li>


                                        @foreach ($sections as $section)

                                        @if (count($section['categories']) > 0)
                                        <li class="dropdown">
                                        <a href="" class="dropdown-toggle" data-toggle="dropdown">{{ data_get($section,'name') }}<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                @foreach (data_get($section,'categories') as $category)
                                                <li class="divider"></li>
                                                <li class="nav-header"><a href="{{ data_get($category,'url') }}">{{ data_get($category,'category_name') }}</a></li>
                                                    @foreach (data_get($category,'subcategories') as $subcategory)
                                                    <li><a href="{{ data_get($subcategory,'url') }}">&nbsp;&raquo;&nbsp;{{ data_get($subcategory,'category_name') }}</a></li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif

                                    @endforeach
                                    {{-- <li>
                                        <a href="men.html">Men</a></li>
                                    <li>
                                        <a href="women.html">Women</a></li> --}}
                                    <li>
                                        <a href="miscelleneous.html">Miscellaneous</a>
                                        </li>
                                    <li><a href="about.html">about us</a>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact US</a> </li>
                                </ul>
                            </nav>
                        </div>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div><img src="{{ asset('images/front_images/icon/search.png') }}" onclick="openSearch()"
                                                class="img-fluid blur-up lazyload" alt=""> <i class="ti-search"
                                                onclick="openSearch()"></i></div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div>
                                                <span class="closebtn" onclick="closeSearch()"
                                                    title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form>
                                                                    <div class="form-group"><input type="text"
                                                                            class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            placeholder="Search a Product"></div>
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="onhover-div mobile-cart">
                                        <div><img src="{{ asset('images/front_images/icon/cart.png') }}"
                                                class="img-fluid blur-up lazyload" alt=""> <i
                                                class="ti-shopping-cart"></i></div>
                                        <ul class="show-div shopping-cart">
                                            <li>
                                                <div class="media">
                                                    <a href="#"><img class="mr-3"
                                                            src="{{ asset('images/front_images/fashion/product/1.jpg') }}"
                                                            alt="Generic placeholder image"></a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h4>item name</h4>
                                                        </a>
                                                        <h4><span>1 x $ 299.00</span></h4>
                                                    </div>
                                                </div>
                                                <div class="close-circle"><a href="#"><i class="fa fa-times"
                                                            aria-hidden="true"></i></a></div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <a href="#"><img class="mr-3"
                                                            src="{{ asset('images/front_images/fashion/product/2.jpg') }}"
                                                            alt="Generic placeholder image"></a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h4>item name</h4>
                                                        </a>
                                                        <h4><span>1 x $ 299.00</span></h4>
                                                    </div>
                                                </div>
                                                <div class="close-circle"><a href="#"><i class="fa fa-times"
                                                            aria-hidden="true"></i></a></div>
                                            </li>
                                            <li>
                                                <div class="total">
                                                    <h5>subtotal : <span>$299.00</span></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="buttons"><a href="cart.html" class="view-cart">view
                                                        cart</a> <a href="#" class="checkout">checkout</a></div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
