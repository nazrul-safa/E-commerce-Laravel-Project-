<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Featured_photo ;
use Carbon\Carbon;
use Image;
use File, Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    function product()
    {
        $category_data = Category::all();
        $subcategory_data = Subcategory:: all();
        $product_data = Product::where('user_id',Auth::id())->get();
        return view('product.index', compact('category_data','product_data','subcategory_data'));
    }
    function product_post(Request $req)
    {   
        $req->validate(
        [
        'category_id' => ['required'],
        'product_name' => ['required','string','max:40'],
        'product_price' => ['required'],
        'product_quantity' => ['required'],
        'product_short_description' => ['required','string'],
        'product_long_description' => ['required','string'],
        'product_alert_quantity' => ['required'],

        ]);
         $this->validate($req,[
         'product_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
         ]);   
        $img = $req->file('product_photo');
        $extention = $img->getClientOriginalExtension();
        $photo_name = Str::random(10).time().'.'.$extention;
        Image::make($img)->resize(600, 622)->save(base_path('public/photo/product/').$photo_name);
        $product_id = Product::insertGetId($req->except('_token','product_photo','featured_photo') +[
            'user_id' => Auth::id(),
            'product_photo' => $photo_name,
            'created_at' => Carbon::now(),
        ]);
        if($req->hasFile('featured_photo')){
        foreach ($req->file('featured_photo') as $single_featured_photo) {
        $img = $single_featured_photo;
        $extention = $img->getClientOriginalExtension();
        $photo_name = Str::random(10).time().'.'.$extention;
        Image::make($img)->resize(600, 622)->save(base_path('public/photo/product_featured/').$photo_name);
        Featured_photo::insert([
            'product_id' => $product_id,
            'featured_photos'=> $photo_name,
            'created_at' => Carbon::now()
        ]);
       }
    }
        return back();
    }
    function product_edit($product_id){
       $category_data = Category::all();
       $product_info = Product::find($product_id);
       $product_data = Product::all();
       return view('product.edit',compact('product_info','category_data','product_data'));
    }
    function product_post_edit(Request $req, $product_id){
        if($req->hasFile('new_photo')){
            //delete old photo
            $old_photo_path= base_path('public/photo/product/').Product::find($product_id)->product_photo;
            unlink($old_photo_path);
            //update new photo
            $img = $req->file('new_photo');
            $extention = $img->getClientOriginalExtension();
            $photo_name = Str::random(10).time().'.'.$extention;
            Image::make($img)->resize(600, 622)->save(base_path('public/photo/product/').$photo_name); 
            
        $req->validate(
            [
                'product_name' => ['required','string']
            ]);
        Product::find($product_id)->update([
            'product_photo' => $photo_name
        ]);
        return back();
    }  
    Product::find($product_id)->update($req->except('_token'));
    return back();
}
    function product_delete($product_id){
        $image_path =base_path('public/photo/product/');
        if(File::exists($image_path)) {
        File::delete($image_path);
        if(Product::where('id',$product_id)->exists()){ //for double click problem
            Product::find($product_id)->delete();
        }
        // $image_path = base_path('public/photo/product/').$req->img;
        // if (file_exists($image_path)) {
        // @unlink($image_path);
        // }
        }
        return back()->with('product_delete', 'Product Deleted Successfully');    
    }             
}
