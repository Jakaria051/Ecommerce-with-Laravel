@php
    use App\Banner;
    $getBanners = Banner::getBanners();
@endphp

   @if (isset($page_name) && $page_name == "index")
   <!-- Home slider -->
   <section class="p-0 height-100">
       <div class="slide-1 home-slider">
        @foreach ($getBanners as $key => $banner)

        <div>
               <div class="home text-center bg-position p-right">

                   <img src="{{ asset('images/banner_images/'.$banner['image']) }}"
                    @if (!empty($banner['alt']))
                   alt="{{ $banner['alt'] }}"
                   @else
                   alt=""
                   @endif
                    class="bg-img blur-up lazyload">


                   <div class="container">
                       <div class="row">
                           <div class="col">
                               <div class="slider-contain">
                                   <div>
                                       <h4 style="color:black;">
                                        @if (!empty($banner['title']))
                                        {{ $banner['title'] }}
                                        @endif
                                    </h4>
                                       <h1>Our collection</h1>
                                       <a

                                       @if (!empty($banner['link']))
                                    href="{{ url($banner['link']) }}"
                                    @else
                                    href="javascript:void(0)"
                                    @endif

                                       class="btn btn-solid">shop now</a>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

        @endforeach

       </div>
</section>
   <!-- Home slider end -->

@endif
