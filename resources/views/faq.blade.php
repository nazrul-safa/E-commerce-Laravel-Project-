@extends('layouts.starlight')
@section('title')
   Faq
@endsection
@section('faq')
    active
@endsection
@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    {{-- <a class="breadcrumb-item" href="index.html">Starlight</a> --}}
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashbord</a>
    <span class="breadcrumb-item active">Faq</span>
  </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">          
            <div class="card-header bg-success">
              <div class="row">
                <div class="col-6">
                  Faqs 
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
                            <th scope="col">Question</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <form action="" method="get">
                          @csrf 
                          @forelse ($faq_data as $faq)
                          <tr>
                            <td>{{ $faq->qus }}</td>
                            <td>{{ $faq->ans }}</td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                               
                                <a href="{{ url('faq/delete') }}/{{ $faq->id }}" type="button" class="btn btn-danger">Delete</a>
                                
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
                <div class="card-header bg-success">Faqs</div>
                <div class="card-body">
                    <form action="{{ route('faq_post') }}" method="POST">
                        @csrf 
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" class="form-control" name="qus">
                        </div>
                        <div class="form-group">
                            <label>Answer</label>
                            <textarea class="form-control"  rows="4" name="ans"></textarea>
                        </div>
                         @if ($errors->all())
                          @foreach ($errors->all() as $error)
                          <span class="text-danger">{{ $error }}</span>
                          @endforeach                     
                          @endif
                          <br>
                          <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
@section('footer_scripts')
@endsection