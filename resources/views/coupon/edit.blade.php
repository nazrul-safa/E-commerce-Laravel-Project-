@extends('layouts.starlight')
@section('title')
   Coupon
@endsection
@section('coupon')
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
 
        <div class="col-6 m-auto" >
            
                <div class="card-header bg-success">Edit Coupon</div>
                <div class="card-body">
                    <form action="{{ route('coupon.update', $coupon->id) }}" method="POST" >
                        @csrf 
                        @method('PATCH')
                        <div class="form-group">
                          <label>Coupon Name</label>
                          <input type="text" class="form-control" placeholder="Enter Coupon Name" name="coupon_name" value="{{ $coupon->coupon_name }}">  
                        </div>
                        <div class="form-group">
                          <label>Discount Amount</label>
                          <input type="text" class="form-control" placeholder="Enter Disscount amount" name="discount_amount" value="{{ $coupon->discount_amount }}">  
                        </div>
                        <div class="form-group">
                          <label>Expire Date</label>
                          <input type="date" class="form-control" placeholder="Enter Coupon Name" name="expire_date" value="{{ $coupon->expire_date }}">  
                        </div>
                        <div class="form-group">
                          <label>User Limit</label>
                          <input type="text" class="form-control" placeholder="Enter user limit" name="uses_limit" value="{{ $coupon->uses_limit }}">  
                        </div>
                          
                        <button type="submit" class="btn btn-primary">Edit Coupon</button>
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