@extends('layouts.tohoney')
@section('title')
   Shop
@endsection
@section('body')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Search Page</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Search Page</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
        
           <div class="row">
               @forelse ($search_products as $product)
                    @include('little_parts.same_prorduct') 
                @empty
                <div class="col-12">
                   <div class="alert alert-danger">
                       <h4 style="text-align:center">No Product to Show</h4>
                   </div> 
                </div>
                   
                @endforelse
           </div>
        </div>
    </div>
    <!-- product-area end -->   
@endsection