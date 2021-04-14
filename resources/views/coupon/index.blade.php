@extends('layouts.starlight')
@section('title')
   Coupon
@endsection
@section('subcategory')
    active
@endsection
@section('breadcrumb')
<nav class="breadcrumb sl-breadcrumb">
    {{-- <a class="breadcrumb-item" href="index.html">Starlight</a> --}}
    <a class="breadcrumb-item" href="{{ url('home') }}">Dashbord</a>
    <span class="breadcrumb-item active">Coupon</span>
  </nav>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">          
            <div class="card-header bg-success">
              <div class="row">
                <div class="col-6">
                   Add Coupon Name
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
                     
                    <table class="table table-dark table-striped">
                        <thead>
                          <tr>
            
                            <th scope="col">Serial No</th>
                            <th scope="col">Coupon Name</th>
                            <th scope="col">Disscount Amount</th>
                            <th scope="col">Expire Date</th>
                            <th scope="col">User limit</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                    
                          @forelse ($coupons as $coupon)
                          <tr>
        
                            <th>{{ $loop->index +1 }}</th>
                            <td>{{ $coupon->coupon_name }}</td>
                            <td>{{ $coupon->discount_amount }} %</td>
                            <td>{{ $coupon->expire_date }}</td>
                            <td>{{ $coupon->uses_limit }}</td>
                            <td>{{ $coupon->created_at->format('d/m/Y h:i:s A') }}</td>
                            <td>
                              @if ($coupon->updated_at)
                              {{ $coupon->updated_at->format('d/m/Y h:i:s A') }}    
                              @else 
                                    NULL
                              @endif
                            </td>
                            <td>
                               <a href="{{ route('coupon.edit',$coupon->id) }}" class="btn btn-info">Edit</a>
                               <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                   <button class="btn btn-danger">Delete</button>
                               </form>
                               
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
            
                <div class="card-header bg-success">Add SubCategory</div>
                <div class="card-body">
                    <form action="{{ route('coupon.store') }}" method="POST" >
                        @csrf 
                       
                        <div class="form-group">
                          <label>Coupon Name</label>
                          <input type="text" class="form-control" placeholder="Enter Coupon Name" name="coupon_name">  
                        </div>
                        <div class="form-group">
                          <label>Discount Amount</label>
                          <input type="text" class="form-control" placeholder="Enter Disscount amount" name="discount_amount">  
                        </div>
                        <div class="form-group">
                          <label>Expire Date</label>
                          <input type="date" class="form-control" placeholder="Enter Coupon Name" name="expire_date">  
                        </div>
                        <div class="form-group">
                          <label>User Limit</label>
                          <input type="text" class="form-control" placeholder="Enter user limit" name="uses_limit">  
                        </div>
                          
                        <button type="submit" class="btn btn-primary">Add Coupon</button>
                        <br>
                        <br>
                
                    </form>
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