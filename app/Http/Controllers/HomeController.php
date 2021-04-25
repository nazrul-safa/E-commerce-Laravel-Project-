<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Order; 
use App\Models\Order_details; 
use Auth;
use PDF;
use Carbon\carbon;
class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $users = User::all();
        //return Order::all();
        $orders = Order::where('user_id',Auth::id())->latest()->get();
        return view('home', compact('users','orders'));
    }
    public function download_invoice($order_id){
        $data=Order::find($order_id);
        $order_details = Order_details::where('order_id',$order_id)->get();
        $pdf = PDF::loadView('pdf.invoice', compact('data','order_details'));
        $name = "invoice".Carbon::now().".pdf";
        return $pdf->stream($name);
    }
}
 