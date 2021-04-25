@extends('layouts.tohoney')

@section('title')
   Categorywise
@endsection

@section('body')
     <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>{{ $category_name->category_name }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcumb-area end -->
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <ul class="row">
                @forelse ($products as $product)
                        @include('little_parts.same_prorduct')   
                @empty
                <div class="col-12">
                    <div class="alert alert-danger">
                        <h4 style="text-align: center">No Product To Show</h4>
                    </div>
                </div>
                @endforelse  
            </ul>
        </div>      
    </div>
    <!-- product-area end -->   
 
@endsection