<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello,</title>
  </head>
  <body>
    <div class="alert alert-success">
      <h2 class="text-center">Invoice</h2>
    </div>
    <div class="col-md-6">
      <strong>To:</strong>
        <p> <strong> Name: {{ $data->customer_name }}</strong></p>
        <p>Address: {{ $data->customer_address }}</p>
        <p>Phone: {{ $data->customer_phone }}</p>
        <p>Email: {{ $data->customer_email }}</p>
    </div>
    {{-- <table class="table table-bordered">
        <tr>
            <td>Name: {{ $data->customer_name }}</td>
            <td>Order ID: {{ $data->id }}</td>
            <td>Order Date Time: {{ $data->created_at }}</td>
        </tr>
    </table> --}}
    <table class="table table-bordered">
        <tr>
            <th>SL. No</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Unit price</th>
            <th>Product price</th>
        </tr>
      @foreach ($order_details as $order_details)
      <tr>
        <td>{{ $loop->index +1 }}</td>
        <td>
            <img src="photo/product/{{ $order_details->reltoproducttable->product_photo }}" alt="" width="50">
        </td>
       
        <td>{{ $order_details->reltoproducttable->product_name }}</td>
        <td>{{ $order_details->quantity }}</td>
        <td>{{ $order_details->reltoproducttable->product_price}}</td>  
        <td>{{ $order_details->reltoproducttable->product_price * $order_details->quantity }}</td>  
        
    </tr>
      @endforeach
    </table>
    <div class="float-right">
      <p>Sub Total: {{ $data->subtotal }}</p>
      <p>Disscount: {{ $data->discount }}%</p>
      <p>Disscount in Am: {{ $data->discount_in_amount }}</p>
      <p>Total: {{ $data->total }}</p>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>