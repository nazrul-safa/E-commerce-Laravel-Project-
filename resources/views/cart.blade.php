@extends('layouts.tohoney')
@section('title')
   cart
@endsection
@section('body')
 <!-- header-area end -->
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100" style="background: url({{ asset('tohoney_assets//images/bg/5.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('updatecart') }}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $flag = false;
                                    $subtotal = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="images"><img src="{{ asset('photo/product')}}/{{ $cart->reltoproducttable->product_photo   }}" alt=""></td>
                                        <td class="product">
                                            <a href="single-product.html">
                                                {{ $cart->reltoproducttable->product_name }}
                                               
                                                @if ($cart->reltoproducttable->product_quantity < $cart->quantity )
                                                    <span class="badge badge-danger">Available Stock:  {{ $cart->reltoproducttable->product_quantity }}</span>  
                                                    @php
                                                        $flag = true;
                                                    @endphp
                                                @endif
                                            </a>
                                        </td>
                                        <td class="ptice">${{ $cart->reltoproducttable->product_price }}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" value="{{ $cart->quantity }}" name="quantity[{{ $cart->id }}]"/>
                                        </td>
                                        <td class="total">
                                            ${{ $cart->reltoproducttable->product_price * $cart->quantity }}
                                            @php
                                                $subtotal = $subtotal + ($cart->reltoproducttable->product_price * $cart->quantity);
                                            @endphp
                                        </td>
                                        <td class="remove">
                                            <a href="{{ url('cart/delete') }}/{{ $cart->id }}">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                                
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit">Update Cart</button>
                                        </li>
                                        <li><a href="{{ url('shop') }}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Coupon</h3>
                                    <p>Enter Your Co upon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Cupon Code" id="apply_coupon_input" value="{{ $coupon_name }}">
                                        <button type="button" id="apply_coupon">Apply Coupon</button>
                                        @if (session('coupon_error'))
                                            <div class="alert alert-danger mt-3">
                                                {{ session('coupon_error') }}
                                            </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>{{ $subtotal }}</li>
                                        <li><span class="pull-left">Discount </span>{{ $coupon_discount }}%</li>
                                        <li><span class="pull-left">Discount(In amount)</span>{{ ($coupon_discount/100)* $subtotal}}</li>
                                        <li><span class="pull-left"> Total </span> {{ $subtotal - (($coupon_discount/100)* $subtotal) }}</li>
                                        @php
                                            session([
                                                'session_subtotal' => $subtotal,
                                                'session_coupon_name' => $coupon_name,
                                                'session_coupon_discount'  => $coupon_discount,
                                                'session_coupon_discount_in_amount'  => ($coupon_discount/100)* $subtotal,
                                                'session_total'  => $subtotal - (($coupon_discount/100)* $subtotal),
                                            ]);
                                        @endphp
                                    </ul>
                                    @if ($flag)
                                        <a href="">Problem </a>
                                    @else
                                        <a href="{{ route('checkout') }}">Proceed to Checkout</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->

@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function(){
            $('#apply_coupon').click(function(){
                var coupon_name = $('#apply_coupon_input').val();
                var link_to_go = "{{ url('cart') }}/" + coupon_name ;
                window.location.href = link_to_go;
            });
        });
    </script> 
@endsection