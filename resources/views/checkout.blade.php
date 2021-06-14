@extends('layouts.tohoney')
@section('title')
   checkout
@endsection
@section('body')
     <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100" style="background: url({{ asset('tohoney_assets//images/bg/5.jpg') }});">
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
                        <form id="main_form" action="{{ route('checkoutpost') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <p>Name *</p>
                                    <input type="text" value="{{ Auth::user()->name }}" name="customer_name">
                                    @error('customer_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" value="{{ Auth::user()->email }}" name="customer_email" >
                                    @error('customer_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}">
                                    @error('customer_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Country *</p>
                                    <select id="country_list" name="customer_country" value="{{ old('customer_country') }}">
                                        <option value="">--Select One--</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>City *</p>
                                    <select id="city_list" name="customer_city" value="{{ old('customer_city') }}">
                                        <option value="">--Select One--</option>
                                    </select>
                                    @error('customer_city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                
                                <div class="col-sm-6 col-12">
                                    <p>Your Address</p>
                                    <input type="text" name="customer_address" value="{{ old('customer_address') }}">
                                    @error('customer_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Postcode/ZIP *</p>
                                    <input type="text" name="customer_postcode" value="{{ old('customer_postcode') }}">
                                    @error('customer_postcode')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                     
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="customer_massage" placeholder="Notes about Your Order, e.g.Special Note for Delivery" value="{{ old('customer_massage') }}"></textarea>
                                </div>
                            </div>
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
                                <input id="card" type="radio" name="payment_option" value="1" class="checked">
                                <label for="card">Credit Card</label>
                            </li>
                            <li>
                                <input id="delivery" type="radio" name="payment_option" value="2">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                            @error('payment_option')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </ul>
                        <button type="button" id="place_order">Place Order</button>
                    </form>
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
                         <div class="alert alert-danger" style="text-align: center"  >
                            <h2>You are not logged in</h2>
                            <br>
                             <h5>If you have already an account</h5>
                             <h5><a href="{{ route('customer_login') }}">Login Here</a></h5>
                             <br>
                             <h5>To Open a new Account </h5>
                             <h5><a href="{{ route('customer_register') }}">Register Here</a></h5>
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
        $('#city_list').select2();
        $('#country_list').change(function(){
            var country_id = $(this).val();
            $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: 'POST',
                url: 'get/city/list',
                data: {country_id:country_id},
                success: function(data){
                    $('#city_list').html(data);
                }
            });
        });
        $('#place_order').click(function(){
            if($("input[name='payment_option']:checked").val()==1){
                var link = "{{ url('pay') }}"
                $('#main_form').attr('action',link);
            }
            else{
                $('#main_form').attr('action','http://127.0.0.1:8000/checkout/post');                
            }
            $("#main_form").submit();
        });
});
    </script>
@endsection