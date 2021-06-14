@extends('layouts.tohoney')
@section('title')
   About
@endsection
@section('body')
     <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100" style="background: url({{ asset('tohoney_assets//images/bg/3.jpg') }});">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="breadcumb-wrap text-center">
                      <h2>About us</h2>
                      <ul>
                          <li><a href="index.html">Home</a></li>
                          <li><span>About</span></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- .breadcumb-area end -->
  <!-- about-area start -->
  <div class="about-area ptb-100">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="about-wrap text-center">
                      <h3>Welcome Our Shop! </h3>
                      <p>Hello! This site is developed by me</p>
                      <br>
                      <p>Now it is in testing purpose</p>
                      
                     
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- about-area end -->
 <!-- product-area start -->
  <div class="product-area product-area-2">
      <div class="container">
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
@endsection