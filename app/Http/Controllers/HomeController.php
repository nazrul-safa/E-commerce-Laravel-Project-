<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Cartorder;
use App\Models\Order_details; 
use App\Models\Review;
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
        $customer_order_details = Cartorder::all();
        //return Cartorder::all();
        $orders = Cartorder::where('user_id',Auth::id())->latest()->get();
        $creditcard=Cartorder::where('payment_option',1)->count();
        $cod=Cartorder::where('payment_option',2)->count();
        return view('home', compact('users','orders','creditcard','cod','customer_order_details'));
    }
    public function download_invoice($order_id){
        $data=Cartorder::find($order_id);
        $order_details = Order_details::where('order_id',$order_id)->get();
        $pdf = PDF::loadView('pdf.invoice', compact('data','order_details'));
        $name = "invoice".Carbon::now().".pdf";
        return $pdf->stream($name);
    }
    public function sendsms(Request $req){
        //return ;
        $customer_details = Cartorder::select('customer_name', 'customer_phone')->get();
        foreach ($customer_details as $customer_detail) {
            $url = "http://66.45.237.70/api.php";
            $number="$req->number";
           // $number="$customer_detail->customer_phone";
            $text="Dear, $customer_detail->customer_name $req->message";
            $data= array(
            'username'=>"01834833973",
            'password'=>"TE47RSDM",
            'number'=>"$number",
            'message'=>"$text"
            );

            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            $p = explode("|",$smsresult);
            echo $sendstatus = $p[0];
            echo "Done";
        }
    }
    function give_review($order_id){
        
        return view('give_review', [
            'order_details' => Order_details::where('order_id',$order_id)->get()
        ]);
    }
    function review_post($order_details_id, Request $request){
          $request->validate([
          'review_text' => ['required','max:60'],
          'stars' => ['required'],
          ]);
       Review::insert([
           'product_id' => Order_details::find($order_details_id)->product_id,
           'user_id' => Auth::id(),
           'order_details_id' => $order_details_id,
           'review_text' => $request->review_text,
           'stars' => $request->stars,
           'created_at' => Carbon::now()
       ]);
      
       return back();
    }
}
 
