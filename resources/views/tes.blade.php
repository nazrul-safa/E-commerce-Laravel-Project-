@extends('layouts.starlight')
@section('title')
   Testimonial
@endsection
@section('tes')
    active
@endsection
@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    {{-- <a class="breadcrumb-item" href="index.html">Starlight</a> --}}
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashbord</a>
    <span class="breadcrumb-item active">Testimonial</span>
  </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">          
            <div class="card-header bg-success">
              <div class="row">
                <div class="col-6">
                  Testimonial 
                </div>
                <div class="col-6 text-right">
                  {{-- @if ($categories->count()!=0)
                  <button id="delete_all_btn" class="btn btn-danger">Delete All</button>
                  @endif --}}
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
                            <th scope="col">Comments</th>
                            <th scope="col">Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">tes_photo</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <form action="" method="get">
                          @csrf 
                          @forelse ($tes_data as $tes)
                          <tr>
                            <td>{{ $tes->comment }}</td>
                            <td>{{ $tes->name }}</td>
                            <td>{{ $tes->designation }}</td>
                            <td> <img src="{{ asset('photo') }}/tes/{{ $tes->tes_photo }}" alt="" style="height: 70px" width="70px"></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">                               
                                <a href="{{ url('tes/delete') }}/{{ $tes->id }}" type="button" class="btn btn-danger">Delete</a>                               
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
                     </form>
                </div>   
        </div>
        
        <div class="col-4">
                <div class="card-header bg-success">Testimonial</div>
                <div class="card-body">
                    <form action="{{ route('tes_post') }}" method="POST"  enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                            <label>Comments</label>
                            <textarea class="form-control"  rows="4" name="comment"></textarea>                        
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" class="form-control" name="designation">
                        </div>
                        <div class="form-group">
                        <label>Client Photo</label>
                        <input type="file" class="form-control" name="tes_photo">
                        @error('tes_photo')
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
                        <button type="submit" class="btn btn-primary">Submit</button>
    
                    </form>
                </div>
              
        </div>  
      
    </div>
</div>
@endsection
@section('footer_scripts')
@endsection