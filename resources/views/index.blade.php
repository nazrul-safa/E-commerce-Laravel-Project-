@extends('layouts.tohoney')
@section('title')
   safa
@endsection
@section('body')
    
    <!-- slider-area start -->
    <div class="slider-area">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide overlay">
                    <div class="single-slider slide-inner" style="background: url({{ asset('tohoney_assets//images/slider/2.jpg') }});">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Welcome to our Shop</h2>
                                            <p data-swiper-parallax="-400">Customer satisfaction is our main Goal</p>
                                            <a href="{{ route('shop') }}" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="swiper-slide">
                    <div class="slide-inner" style="background: url({{ asset('tohoney_assets//images/slider/4.jpg') }});">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Welcome to our Shop</h2>
                                            <p data-swiper-parallax="-400">Customer satisfaction is our main Goal</p>
                                            <a href="{{ route('shop') }}" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-inner" style="background: url({{ asset('tohoney_assets//images/slider/5.jpg') }});">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">Welcome to our Shop</h2>
                                            <p data-swiper-parallax="-400">Customer satisfaction is our main Goal</p>
                                            <a href="{{ route('shop') }}" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- slider-area end -->
    <!-- featured-area start -->
    <div class="featured-area featured-area2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="featured-active2 owl-carousel next-prev-style">
                        @foreach ($categories as $category)
                            <div class="featured-wrap">
                            <div class="featured-img">
                                <img src="{{ asset('photo') }}/category/{{ $category->category_photo }}" alt="">
                                <div class="featured-content">
                                    <a href="{{ url('categorywise/shop')}}/{{ $category->id }}">{{ $category->category_name }}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured-area end -->
    <!-- start count-down-section -->
    <div class="count-down-area count-down-area-sub">
        <section class="count-down-section section-padding parallax" data-speed="7">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 text-center">
                        <h2 class="big">Deal Of the Day <span>Welcome to our shop. Big surprise is waitng for you. </span></h2>
                    </div>
                    <div class="col-12 col-lg-12 text-center">
                        <div class="count-down-clock text-center">
                            <div id="clock">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </div>
    <!-- end count-down-section -->
    <!-- product-area start -->
    <div class="product-area product-area-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Best Seller</h2>
                        <img src="{{ asset('tohoney_assets') }}/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
                @foreach ($sorted_best_seller as $pro)
                     @php
                         $product = App\Models\Product::find($pro->product_id )
                     @endphp   
                @include('little_parts.same_prorduct')
                @endforeach
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- product-area start -->
    <div class="product-area">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest Product</h2>
                        <img src="{{ asset('tohoney_assets') }}/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
                @foreach ($latest_products as $product)
                    @include('little_parts.same_prorduct')
                @endforeach
                <li class="col-12 text-center">
                    <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- testmonial-area start -->
    <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity" style="background: url({{ asset('tohoney_assets//images/bg/1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="test-title text-center">
                        <h2>What Our client Says</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 col-12">
                    <div class="testmonial-active owl-carousel">
                        @foreach ($tes_info as $tes)

                            <div class="test-items test-items2">
                            <div class="test-content">
                                <p>{{ $tes->comment }}</p>
                                <h2>{{ $tes->name }}</h2>
                                <p>{{ $tes->designation }}</p>
                            </div>
                            <div class="test-img2">
                                <img src="{{ asset('photo') }}/tes/{{ $tes->tes_photo }}" alt="">
                            </div>
                        </div>
                        @endforeach
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
  
@endsection