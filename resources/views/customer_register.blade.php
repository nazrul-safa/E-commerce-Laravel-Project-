@extends('layouts.tohoney')
@section('title')
   customer_register
@endsection
@section('body')
     <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Account</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Register</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <form action="{{ route('customer_post') }}" method="POST">
                        @csrf
                        <div class="account-form form-style">
                            <p> Name *</p>
                            <input type="text" name="name">
                            <p> Email Address *</p>
                            <input type="email" name="email">
                            <p>Password *</p>
                            <input type="Password" name="password">
                            <p>Confirm Password *</p>
                            <input type="Password" name="confirm_password">
                            <button>Register</button>
                            <div class="text-center">
                                <a href="{{ route('customer_login') }}">Or Login</a>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection