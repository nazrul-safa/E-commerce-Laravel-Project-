@extends('layouts.starlight')
@section('title')
   Sub-Category
@endsection
@section('subcategory')
    active
@endsection
@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    {{-- <a class="breadcrumb-item" href="index.html">Starlight</a> --}}
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashbord</a>
    <span class="breadcrumb-item active">Add Review</span>
  </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">          
            <div class="card-header ">
              <div class="row">
                <div class="col-6">
                   Add Review
                </div>
                <div class="col-6 text-right">
                  {{-- @if ($categories->count()!=0)
                  <button id="delete_all_btn" class="btn btn-danger">Delete All</button>
                  @endif --}}
                </div>
              </div>
              </div>
                <div class="card-body">
                    @foreach ($order_details as $order_detail)
                      @if (App\Models\Review::where('order_details_id', $order_detail->id)->exists())
                       Done        
                       @else
                           <div class="card">
                            <div class="card-header">
                                  {{ App\Models\Product::find($order_detail->product_id)->product_name }}
                            </div>
                            <div class="card-header">
                                <form action="{{ route('review_post' , $order_detail->id) }} " method="POST">
                                    @csrf
                                    <input type="text" name="review_text" class="form-control">
                                    @error('review_text')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <input type="range" id="points" name="stars" min="1" max="5" value="1" step="1">
                                    @error('stars')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <button type="submit" class="btn btn-success"> Give Review</button>
                                </form>
                            </div>
                        </div>
                       @endif                                       
                    @endforeach
                </div>   
        </div>
        
      
    </div>
</div>
@endsection
