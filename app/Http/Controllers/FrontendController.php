<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Faq;
use App\Models\User;
use App\Models\Tes;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\City;
use App\Models\Order;
use App\Models\Order_details;
use Carbon\Carbon;
use Hash;
use Auth;
class FrontendController extends Controller
{
    function home(){
        $categories = Category::all();
        $tes_info = Tes::all();
        $products = Product::latest()->get();
        return view('index',compact('categories','products','tes_info'));
    }
    function about(){
        $name = [
            "safa", "Arif", "helooooo"
        ];
        return view('about', compact('name'));
    }
    
    function users(){
        return view('user');
    }
    function product_details($product_id){
        $product_category_id = Product::findorfail($product_id)->category_id;
        $product_info = Product::findorfail($product_id);
        $related_product = Product::where('category_id',$product_category_id)->where('id','!=',$product_id)->get();
        $faq_info= Faq::all();
        return view('product.details',compact('product_info','faq_info','related_product'));
    }
    
    function shop(){
        $all_products = product::inRandomOrder()->get();
        $categories = Category::all();
        return view('shop',compact('all_products','categories'));
    }
    function categorywise($category_id){
        $products = Product::where('category_id',$category_id)->get();
        $category_name = Category::findorfail($category_id);
        //$product_info = Product::findorfail($product_id);
        $product_info = Product::findorfail($category_id);
        return view('categorywise',compact('products','category_name','product_info'));
    }

    function contact_get(){
        return view('contact');
    }
    
    function cart($coupon_name = ''){
        $coupon_discount = 0;
        if ($coupon_name == '') {
            $coupon_discount = 0;
        }
        else{
            
            if (Coupon::where('coupon_name',$coupon_name)->exists()) {
                if (Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name',$coupon_name)->first()->expire_date) {
                
                    return back()->with('coupon_error', 'This coupon is Expired');
               }
               else{
                   if(Coupon::where('coupon_name',$coupon_name)->first()->uses_limit > 0){
                     $coupon_discount = Coupon::where('coupon_name',$coupon_name)->first()->discount_amount; 
                   }
                    else{
                        return back()->with('coupon_error', 'This coupon Limit is sesh');
                    }
               }
            }
            else{
                return back()->with('coupon_error', 'Invalid Coupon Name');
            }
        }
        
        $carts = Cart::where('ip_address',request()->ip())->get();
        $coupon_discount;
        $coupon_name;
        return view('cart',compact('carts','coupon_discount','coupon_name'));
    }
    function updatecart(Request $req){
        foreach($req->quantity as $cart_id => $quantity){
            if(Product::find(Cart::find($cart_id)->product_id)->product_quantity>=$quantity){
            Cart::find($cart_id)->update([
                'quantity' => $quantity
            ]);
            }
        }
       return back();
    }
    function checkout(){
        $countries= Country::select('id','name')->get();
        //$cities= City::select('id','name')->get();
        return view('checkout',compact('countries'));
    }
    function customer_register(){
        return view('customer_register');
    }
    function customer_post(Request $req){
        $req->validate([
            'name' => ['required','max:40'],
            'email' => ['required','unique:users','email'],
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            ]);
        User::insert([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'role' => 2,
            'created_at' => Carbon::now()
        ]);
        if( User::where('email',$req->email)->exists()){
            $db_password =  User::where('email',$req->email)->first()->password;
            if (Hash::check($req->password, $db_password)) {
                if(Auth::attempt($req->except('_token'))){
                    return redirect('/');
                } 
            }
        }
    }
    function customer_login(){
        return view('customer_login');
    }

    function customer_login_post(Request $req){    
       if( User::where('email',$req->email)->exists()){
           $db_password =  User::where('email',$req->email)->first()->password;
           if (Hash::check($req->password, $db_password)) {
             if(Auth::attempt($req->except('_token'))){
                 return redirect('/');
             }  
           }
           else{
               return back()->with('customer_login_error','Your email or password is incorrect');
           }
       }
       else{
           return back()->with('customer_login_error','Email Not Found');
       }
    }
    function getcitylist(Request $req){
        $str_to_send = "";
        foreach (City::where('country_id',$req->country_id)->select('id','name')->get() as $city) {
            $str_to_send = $str_to_send. "<option value='".$city->id."'>$city->name</option>" ;
        }
        echo $str_to_send;
    }
    function checkoutpost(Request $req){
        $req->validate(
            [
            'customer_name' => ['required','string','max:40'],
            'customer_email' => ['required','string','max:40'],
            'customer_phone' => ['required'],
            'customer_country' => ['required'],
            'customer_city' => ['required'],
            'customer_address' => ['required'],
            'customer_postcode' => ['required'],
            'payment_option' => ['required'],
            ]);
        if($req->payment_option==1){
            echo "Cash on card";
        }
        else{
            $order_id = Order::insertGetId($req->except('_token')+[
                'user_id' => Auth::id(),
                'payment_status' => 1,
                'discount' => session('session_coupon_discount'),
                'discount_in_amount' => session('session_coupon_discount_in_amount'),
                'subtotal' => session('session_subtotal'),
                'total' => session('session_total'),
                'created_at'=> Carbon::now()
            ]);
           $carts = Cart::where('ip_address',request()->ip())->select('id','product_id','quantity')->get();
           foreach($carts as $cart){
               Order_details::insert([
                'order_id' => $order_id,
                'product_id' =>$cart->product_id,
                'quantity' => $cart->quantity,
                'created_at'=> Carbon::now(),
            ]);
            Product::find($cart->product_id)->decrement('product_quantity',$cart->quantity);
            Cart::find($cart->id)->delete();   
        } 
           return redirect("home");
        }
    }
     
} 
