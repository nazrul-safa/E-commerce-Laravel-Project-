@extends('layouts.tohoney')
@section('title')
   customer_login
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
                        <li><span>Login</span></li>
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
        
                @if (session('customer_login_error'))
                    <div class="alert alert-danger">
                        {{ session('customer_login_error') }}
                    </div>
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
                <form action="{{ route('customer_login_post') }}" method="post">
                    @csrf
                    <div class="account-form form-style">
                        <p>User Name or Email Address *</p>
                        <input type="email" name="email">
                        <p>Password *</p>
                        <input type="Password" name="password">
                        <button>SIGN IN</button>
                        <div class="text-center">
                            <a href="{{ route('customer_register') }}">Or Creat an Account</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection