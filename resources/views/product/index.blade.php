@extends('layouts.starlight')
@section('title')
   Category
@endsection
@section('product')
    active
@endsection
@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    {{-- <a class="breadcrumb-item" href="index.html">Starlight</a> --}}
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashbord</a>
    <span class="breadcrumb-item active">Product</span>
  </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">          
            <div class="card-header">
              <div class="row">
                <div class="col-6">
                  Product List
                </div>
                <div class="col-6 text-right">
                  {{-- @if ($deleted_categories->count()!=0)
                  <a href="{{ url('category/restore_all') }}" type="button" class="btn btn-success">Restore All</a>
                  <a href="{{ url('category/force_delete_all') }}" type="button" class="btn btn-danger">Force Delete All</a>
                  @endif --}}
                </div>
              </div>
              </div>
                <div class="card-body">
                    <table class="table table-dark table-striped">
                        <thead>
                          <tr>
                            
                            <th scope="col">Category Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Product Quantity</th>
                            <th scope="col">Product short description</th>
                            <th scope="col">Product long description</th>
                            <th scope="col">Product alert quantity</th>
                            <th scope="col">Added By</th>
                            <th scope="col">Product product photo</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          @forelse ($product_data as $product)
                          <tr>
                            <td>{{ App\Models\Category::find($product->category_id)->category_name }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->product_quantity }}</td>
                            <td>{{ $product->product_short_description }}</td>
                            <td>{{ $product->product_long_description }}</td>
                            <td>{{ $product->product_alert_quantity }}</td>
                            <td>{{ App\Models\User::find($product->user_id)->name }}</td>
                            <td> <img src="{{ asset('photo') }}/product/{{ $product->product_photo }}" alt="" style="height: 70px" width="70px"></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ url('product/edit') }}/{{ $product->id }}" type="button" class="btn btn-info">Edit</a>
                                <a href="{{ url('product/delete') }}/{{ $product->id }}" type="button" class="btn btn-danger">Delete</a>
                                {{-- <a href="{{ route('product_edit')}}/{{ $product->id }}" type="button" class="btn btn-info">Edit</a> --}}
                              </div>
                            </td>
                          </tr>   
                          @empty
                          <tr class="text-center text-danger">
                            <td colspan="50">
                             No Data to Show
                            </td>
                          </tr>           
                          @endforelse 
                        </tbody>
                    </table>
                </div>   
        </div>
    </div>
    <div class="col-6 m-auto" >
            <div class="card-header">Add Product</div>
            <div class="card-body">
                <form action="{{ route('product_post') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-group">
                        <label>Category Name</label>
                        <select id="category_list" class="form-control" name="category_id">
                           <option value="">-Choose One-</option>
                           @foreach ($category_data as $category)
                           <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sub Category Name</label>
                        <select id="subcategory_list" class="form-control" name="subcategory_id">
                           <option value="">-Choose One-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="product_name">
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" name="product_price">
                    </div>
                    <div class="form-group">
                        <label>Product Quantity</label>
                        <input type="text" class="form-control" name="product_quantity">
                    </div>
                    <div class="form-group">
                        <label>Product Short Description</label>
                        <textarea class="form-control"  rows="4" name="product_short_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Product Long Description</label>
                        <textarea class="form-control"  rows="4" name="product_long_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Product Alert Quantity</label>
                        <input type="text" class="form-control" name="product_alert_quantity">
                    </div>
                    <div class="form-group">
                        <label>Product Photo</label>
                        <input type="file" class="form-control" name="product_photo">
                        @error('product_photo')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                    </div>
                    <div class="form-group">
                      <label>Featured Photos</label>
                      <input type="file" class="form-control" name="featured_photo[]" multiple>
                      @error('product_photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
          
                       @if ($errors->all())
                          @foreach ($errors->all() as $error)
                            <span class="text-danger">{{ $error }}</span>
                          @endforeach 
                        @endif
                    <br>  
                    <br>  
                    <button type="submit" class="btn btn-primary">Add category New</button>
                    <br>
                </form>
            </div>
        </div>      
</div>
@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function() {
        $('#category_list').select2();
        $('#subcategory_list').select2();
        $('#category_list').change(function(){
            var category_id = $(this).val();
            $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: 'POST',
                url: 'get/subcategory/post',
                data: {category_id:category_id},
                success: function(data){
                    $('#subcategory_list').html(data);
                }
            });
        });
});
</script>
@endsection