@extends('layouts.starlight')
@section('title')
Edit Product-{{ $product_info->product_name  }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 m-auto" >
          @section('breadcrumb')
          <nav class="breadcrumb sl-breadcrumb">
              <a class="breadcrumb-item" href="{{ url('home') }}">Dashbord</a>
              <a class="breadcrumb-item" href="{{ route('product') }}">Product</a>
              <span class="breadcrumb-item active">Edit Product</span>
            </nav>
          @endsection
                <div class="card-header bg-success">Product Form</div>
                <div class="card-body">
                    <input type="hidden" value="{{ $product_info->id }}" name="product_id"> 
                    <form action="{{ route('product_post_edit',$product_info->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                    
                        <div class="form-group">
                          <label>Edit Product</label>
                                   
                          <div class="form-group">
                            <label>Category Name- {{ $product_info->category_id }}</label>
                            <select class="form-control" name="category_id">
                               <option  value="">--select one--</option>
                               @foreach ($category_data as $category)       
                                    <option value="{{ $category->id }}" {{ ($product_info->category_id == $category->id)? 'selected': '' }}>{{ $category->category_name }}</option>                            
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label> 
                            <input type="text" class="form-control" name="product_name" value="{{ $product_info->product_name }}">
                            @if ($errors->all())
                            @foreach ($errors->all() as $error)
                            <span class="text-danger">{{ $error }}</span>
                            @endforeach             
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" name="product_price" value="{{ $product_info->product_price }}">
                        </div>
                        <div class="form-group">
                            <label>Product Quantity</label>
                            <input type="text" class="form-control" name="product_quantity" value="{{ $product_info->product_quantity }}">
                        </div>
                        <div class="form-group">
                            <label>Product Short Description</label>
                            <textarea class="form-control"  rows="4" name="product_short_description">{{ $product_info->product_short_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Long Description</label>
                            <textarea class="form-control"  rows="4" name="product_long_description" >{{ $product_info->product_long_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Alert Quantity</label>
                            <input type="text" class="form-control" name="product_alert_quantity" value="{{ $product_info->product_alert_quantity }}">
                        </div>
                        <div class="form-group">
                            <label>Current photo</label>
                            <img class="w-50" src="{{ asset('photo/product/'.$product_info->product_photo) }}" alt="None">
                        </div>
                        <div class="form-group">
                            <label>New Photo</label>
                            <input type="file" class="form-control" name="new_photo" value="">
                        </div> 
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Product</button>
                        <br>
                        <br>
                        {{-- @if(session('category_insert_name'))
                        <div class="alert alert-success">
                             {{ session('category_insert_name') }}
                        </div>
                        @endif --}}
                    </form>
                </div>   
        </div>    
    </div>
</div>
@endsection
