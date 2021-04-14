@extends('layouts.starlight')
@section('title')
Edit Category-{{ $category_info->category_name  }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 m-auto" >
          @section('breadcrumb')
          <nav class="breadcrumb sl-breadcrumb">
              <a class="breadcrumb-item" href="{{ url('home') }}">Dashbord</a>
              <a class="breadcrumb-item" href="{{ url('category') }}">Category</a>
              <span class="breadcrumb-item active">Edit Category</span>
            </nav>
          @endsection
                <div class="card-header bg-success">Category Form</div>
                <div class="card-body">
                    <form action="{{ url('category/post/edit') }}" method="POST">
                        @csrf 
                    
                        <div class="form-group">
                          <label>Edit Category</label>
                          <input type="hidden" value="{{ $category_info->id }}" name="category_id">
                          <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ $category_info->category_name }}">
                        
                          @if ($errors->all())
                          @foreach ($errors->all() as $error)
                          <span class="text-danger">{{ $error }}</span>
                          @endforeach
                          
                          @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Edit category</button>
                        <br>
                        <br>
                        @if(session('category_insert_name'))
                        <div class="alert alert-success">
                             {{ session('category_insert_name') }}
                        </div>
                        @endif
                    </form>
                </div>
              
        </div>    
    </div>
</div>
@endsection
