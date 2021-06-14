@extends('layouts.tohoney')
@section('title')
   Contact
@endsection
@section('body')
     <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100" style="background: url({{ asset('tohoney_assets//images/bg/3.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Contact Us</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Contact</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- contact-area start -->
    <div class="google-map">
        <div class="contact-map">
            <iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Bashundhara%20R/A%20,%20Dhaka+(e.nazrulsafa.com)&amp;t=k&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"> allowfullscreen></iframe>
        </div>
    </div>
    <div class="contact-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="contact-form form-style">
                            @if(session('mesg_send'))
                                <div class="alert alert-success">
                                    {{ session('mesg_send') }}
                                </div>
                            @endif
                        <form action="{{ route('contact_post') }}" method="post" >
                            @csrf 
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <input type="text" placeholder="Name" value="{{ old('fname') }}" name="fname">
                                    @error('fname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12  col-sm-6">
                                    <input type="text" placeholder="Email" value="{{ old('email') }}" name="email">
                                     @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" placeholder="Subject" value="{{ old('subject') }}" name="subject">
                                     @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <textarea class="contact-textarea" placeholder="Message" value="{{ old('msg') }}"  name="msg"></textarea>
                                     @error('msg')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit">SEND MESSAGE</button>
                                </div>                            
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="contact-wrap">
                        <ul>
                            <li>
                                <i class="fa fa-home"></i> Address:
                                <p> {{ App\Models\Setting::where('setting_name','Address')->first()->setting_value }}</p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> Email address:
                                <p>
                                    <span> {{ App\Models\Setting::where('setting_name','email')->first()->setting_value }}</span>
                                    <span> {{ App\Models\Setting::where('setting_name','email2')->first()->setting_value }} </span>
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> phone number:
                                <p>
                                    <span> {{ App\Models\Setting::where('setting_name','phone')->first()->setting_value }}</span>
                                    <span> {{ App\Models\Setting::where('setting_name','phone2')->first()->setting_value }}</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-area end -->
@endsection