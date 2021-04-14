@extends('layouts.starlight')
@section('title')
   Dashbord
@endsection
@section('dashbord')
    active
@endsection
@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    {{-- <a class="breadcrumb-item" href="index.html">Starlight</a>
    <a class="breadcrumb-item" href="index.html">Pages</a> --}}
    <span class="breadcrumb-item active">Dashbord</span>
  </nav>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-success">
                        Total user: {{ $users->count() }}
                    </div>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Serial NUmber</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>                            
                            <th scope="col">Account Created At</th>                            
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr> 
                                    <td>{{ $loop->index+1 }}</td>                       
                                    <td>{{ Str::title($user->name) }}</td>
                                    <td>{{ $user->email }}</td>             
                                    <td>{{ $user->created_at->diffForHumans()}}</td>             
                                </tr>
                             @endforeach
                        </tbody>
                      </table>
                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
