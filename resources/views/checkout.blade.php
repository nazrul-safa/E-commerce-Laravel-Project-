@extends('layouts.tohoney')
@section('title')
   checkout
@endsection
@section('body')
     <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    @auth
    @if (Auth::user()->role==2)
          <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details
                            (Loggin as: {{ Auth::user()->name }})
                        </h3>
                        <form action="" method="">
                            <div class="row">
                                <div class="col-12">
                                    <p>Name *</p>
                                    <input type="text" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Country *</p>
                                    <select id="country_list">
                                        <option value="">--Select One--</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>City *</p>
                                    <select>
                                        <option value="">Dhaka</option>
                                    </select>
                                </div>                                
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Postcode/ZIP</p>
                                    <input type="email">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Town/City *</p>
                                    <input type="text">
                                </div>                     
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                        
                            <li>Coupon Name <span class="pull-right"><strong>{{ (session('session_coupon_name'))? session('session_coupon_name') :'Not Applicable' }}</strong></span></li>
                            <li>Subtotal <span class="pull-right"><strong>${{ session('session_subtotal') }}</strong></span></li>
                            <li>Discount <span class="pull-right">{{ session('session_coupon_discount') }}%</span></li>
                            <li>Discount(In amount) <span class="pull-right">${{ session('session_coupon_discount_in_amount') }}</span></li>
                            <li>Shipping <span class="pull-right">Free</span></li>
                            <li>Total<span class="pull-right">${{ session('session_total') }}</span></li>
                        </ul>
                        <ul class="payment-method">                            
                            <li>
                                <input id="card" type="radio" name="payment_option">
                                <label for="card">Credit Card</label>
                            </li>
                            <li>
                                <input id="delivery" type="radio" name="payment_option">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>
                        <button>Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
    @else
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                       You are an Admin , You Can't Checkout.
                       </div>
                </div>
           </div>     
       </div>    
   </div> 
    @endif
       
    @else
        <div class="checkout-area ptb-100">
             <div class="container">
                 <div class="row">
                     <div class="col-12">
                         <div class="alert alert-danger">
                            YOU ARE  looged in
                            <br>
                             If you have already an account
                             <a href="{{ route('customer_login') }}">Login Here</a>
                             To Open a new Account <a href="{{ route('customer_register') }}">Register Here</a>
                            </div>
                     </div>
                </div>     
            </div>    
        </div>  
    @endauth
   
@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {
        $('#country_list').select2();
});
    </script>
@endsection