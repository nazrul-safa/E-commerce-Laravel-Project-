<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\Product;
use Carbon\carbon;
class CartController extends Controller
{
    function addtocart(Request $req, $product_id){
    if($req->quantity > Product::find($product_id)->product_quantity){
        return back() -> with('error',"Stock is not available");
    }
    
        if (Cart::where('product_id',$product_id)->where('ip_address', request()->ip())->exists()) {
            Cart::where('product_id',$product_id)->where('ip_address', request()->ip())->increment('quantity',$req->quantity);
        }
        else{
            Cart::insert([
                'product_id' => $product_id,
                'quantity' => $req->quantity,
                'ip_address' => request()->ip(),
                'created_at' => Carbon::now()
            ]);
        }    
        return back();
    }
    function cartdelete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }
}
