@extends('layouts.starlight')
@section('title')
   Category
@endsection
@section('category')
    active
@endsection
@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    {{-- <a class="breadcrumb-item" href="index.html">Starlight</a> --}}
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashbord</a>
    <span class="breadcrumb-item active">Category</span>
  </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">          
            <div class="card-header bg-success">
              <div class="row">
                <div class="col-6">
                  Categories Name
                </div>
                <div class="col-6 text-right">
                  @if ($categories->count()!=0)
                  <button id="delete_all_btn" class="btn btn-danger">Delete All</button>
                  @endif
                </div>
              </div>
              </div>
                <div class="card-body">
                    @if(session('category_delete'))
                    <div class="alert alert-danger">
                         {{ session('category_delete') }}
                    </div>
                    @endif
                    @if(session('category_update'))
                        <div class="alert alert-success">
                             {{ session('category_update') }}
                        </div>
                        @endif
                    <table class="table table-dark table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Delete</th>
                            <th scope="col">Serial No</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Category Photo</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <form action="{{ route('safa') }}" method="POST">
                          @csrf 
                          @forelse ($categories as $category)
                          <tr>
                            <th>
                              <input type="checkbox" class="delete_checkbox" name="category_id[]" value=" {{ $category->id }}">
                            </th>
                            <th>{{ $loop->index +1 }}</th>
                            <td>{{ $category->category_name }}</td>
                            <td> <img src="{{ asset('photo') }}/category/{{ $category->category_photo }}" alt="" style="height: 70px" width="70px"></td>
                            <td>{{ $category->created_at->format('d/m/Y h:i:s A') }}</td>
                            <td>
                              @if ($category->updated_at)
                              {{ $category->updated_at->format('d/m/Y h:i:s A') }}    
                              @else 
                                    NULL
                              @endif
                            </td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ url('category/edit') }}/{{ $category->id }}" type="button" class="btn btn-info">Edit</a>
                                <a href="{{ url('category/delete') }}/{{ $category->id }}" type="button" class="btn btn-danger">Delete</a>
                                
                              </div>
                            </td>
                            
                          </tr>   
                          @empty
                          <tr class="text-center text-danger">
                            <td colspan="50">
                              No Data To show
                            </td>
                          </tr>           
                          @endforelse 
                        </tbody>
                    </table>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-secondary" id="check_all_btn">Check all</button>
                      <button type="button" class="btn btn-info" id="uncheck_all_btn">Uncheck Check all</button>
                    </div>

                    <button type="submit" class="btn btn-danger">Delete checked</button>
                     </form>
                </div>   
        </div>
        
        <div class="col-4">
            
                <div class="card-header bg-success">Category Form</div>
                <div class="card-body">
                    <form action="{{ url('category/post') }}" method="POST"  enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ old('category_name') }}">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror 
                         </div>
                        <div class="form-group">
                            <label>Sub Category Name</label>
                            <input type="text" class="form-control" placeholder="Enter Sub Category Name" name="subcategory_name" value="{{ old('subcategory_name') }}">
                    
                         </div>

                          <div class="form-group">
                            <label>category Photo</label>
                            <input type="file" class="form-control" name="category_photo">
                            @error('category_photo')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                            
                        <button type="submit" class="btn btn-primary">Add category New</button>
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
        <div class="col-8">          
          <div class="card-header bg-warning mt-5  ">
            <div class="row">
              <div class="col-6">
                Categories Name
              </div>
              <div class="col-6 text-right">
                @if ($deleted_categories->count()!=0)
                <a href="{{ url('category/restore_all') }}" type="button" class="btn btn-success">Restore All</a>
                <a href="{{ url('category/force_delete_all') }}" type="button" class="btn btn-danger">Force Delete All</a>
        
                @endif
              </div>
            </div>
            </div>
              <div class="card-body">
                  
              
                  <table class="table table-dark table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Serial No</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">Category Photo</th>
                          <th scope="col">Created At</th>
                          <th scope="col">Updated At</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody> 
                        @forelse ($deleted_categories as $deleted_category)
                        <tr>
                          <th>{{ $loop->index +1 }}</th>
                          <td>{{ $deleted_category->category_name }}</td>
                          <td> <img src="{{ asset('photo') }}/category/{{ $deleted_category->category_photo }}" alt="" style="height: 70px" width="70px"></td>
                          <td>{{ $deleted_category->created_at->format('d/m/Y h:i:s A') }}</td>
                          <td>{{ $deleted_category->updated_at->format('d/m/Y h:i:s A') }}</td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <a href="{{ url('category/restore') }}/{{ $deleted_category->id }}" type="button" class="btn btn-success">Restore</a>
                              <a href="{{ url('category/forcedelete') }}/{{ $deleted_category->id }}" type="button" class="btn btn-danger">Force Delete</a>
                              
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
</div>
@endsection
@section('footer_scripts')
<script>
  $(document).ready (function(){
    $('#delete_all_btn').click(function(){
      Swal.fire({
        title: 'Are you sure You want to Delete all?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href= "category/all/delete";
        }
      })
    }) 
     $('#check_all_btn').click(function(){
       $('.delete_checkbox').attr('checked','checked');
     });
     $('#uncheck_all_btn').click(function(){
       $('.delete_checkbox').removeAttr('checked');
     });
  });
</script>
@endsection