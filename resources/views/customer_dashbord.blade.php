
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  </head>
  <body>
     <div class="container">
         <div class="col-md-auto">
            <div class="card">
                <div class="card-header">
                    Hello Customer
                </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>{{ $order->total }}</td>
                                <td>
                                    <a href="{{ url('download/invoice') }}/{{ $order->id }}">
                                        <i class="fa fa-download">Download Invoice</i>
                                    </a>
                                    <br>
                                    <a href="{{ url('give/review') }}/{{ $order->id }}">
                                        <i class="fa fa-star">Give Review</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                  </div>
                </div>
     </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> 
  </body>
</html>








