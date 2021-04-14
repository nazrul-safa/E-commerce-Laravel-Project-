<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Faq;
use App\Models\Tes;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
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
        $product_category_id = Product::find($product_id)->category_id;
        $product_info = Product::find($product_id);
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
        $category_name = Category::find($category_id);
        return view('categorywise',compact('products','category_name'));
    }

    function contact_get(){
        return view('contact');
    }
    
    function cart($coupon_name = 'coupon nai'){
        $coupon_discount = 0;
        if ($coupon_name == 'coupon nai') {
            $coupon_discount = 0;
        }
        else{
            
            if (Coupon::where('coupon_name',$coupon_name)->exists()) {
                if (Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name',$coupon_name)->first()->expire_date) {
                    echo 'expired' ;
               }
               else{
                   if(Coupon::where('coupon_name',$coupon_name)->first()->uses_limit > 0){
                     $coupon_discount = Coupon::where('coupon_name',$coupon_name)->first()->discount_amount; 
                   }
                    else{
                        echo 'limit sesh';
                    }
               }
            }
            else{
                echo 'invalid';
            }
        }
        
        $carts = Cart::where('ip_address',request()->ip())->get();
        $coupon_discount;
        return view('cart',compact('carts','coupon_discount'));
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
     
} 
