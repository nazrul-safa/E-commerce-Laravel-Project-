@extends('layouts.starlight')
@section('title')
   Setting
@endsection
@section('setting')
    active
@endsection
@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    {{-- <a class="breadcrumb-item" href="index.html">Starlight</a> --}}
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashbord</a>
    <span class="breadcrumb-item active">Setting</span>
  </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">          
            <div class="card-header">
              <div class="row">
                <div class="col-6">
                  Setting
                </div>
              </div>
              </div>
        </div>
    </div>
    <div class="col-12 m-auto" >

            <div class="card-body">
                <form action="{{ route('setting_post') }}" method="POST" >
                    @csrf 
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="phone" value="{{ $settings->where('setting_name','phone')->first()->setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Phone Number 2</label>
                        <input type="text" class="form-control" name="phone2" value="{{ $settings->where('setting_name','phone2')->first()->setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Telephone Number</label>
                        <input type="text" class="form-control" name="telephone" value="{{ $settings->where('setting_name','telephone')->first()->setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" name="email" value="{{ $settings->where('setting_name','email')->first()->setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Email Address 2</label>
                        <input type="text" class="form-control" name="email2" value="{{ $settings->where('setting_name','email2')->first()->setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="Address" value="{{ $settings->where('setting_name','Address')->first()->setting_value }}">
                    </div>
                    <div class="form-group">
                        <label>Footer Description</label>
                        <input type="text" class="form-control" name="footer_des" value="{{ $settings->where('setting_name','footer_des')->first()->setting_value }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <br>
                </form>
            </div>
        </div>      
    </div>
@endsection
@section('footer_scripts')

@endsection