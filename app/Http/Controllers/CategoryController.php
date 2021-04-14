<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function category(){
        $categories = Category::all();
        $deleted_categories =  Category::onlyTrashed()->get();   
        return view('category.index', compact('categories','deleted_categories'));
    }
    function categorypost(Request $req){ 
        $req->validate(
        [
            'category_name' => ['required','string','max:20','unique:categories,category_name']
        ],
        [
            'category_name.required' => 'Category field empty',
            'category_name.max'=> 'should be below 20 ',
        ]);
       // echo $req->category_name;
        $this->validate($req,[
        'category_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $img = $req->file('category_photo');
        $extention = $img->getClientOriginalExtension();
        $photo_name = Str::random(10).time().'.'.$extention;
        Image::make($img)->resize(600, 622)->save(public_path(path:'photo/category/').$photo_name);
        $category_id = Category ::insertGetId([
        'category_name' => $req->category_name,
        'category_photo' => $photo_name,
        'created_at' => Carbon::now()
        ]);
        Subcategory::insert([
            'category_id' => $category_id,
            'subcategory_name' => $req->subcategory_name,
            'created_at' => Carbon::now()
        ]);
        
        return back()->with('category_insert_name', 'Category '.$req->category_name.' Added Successfully');
    }
    function categorydelete($category_id){
        
        if(Category::where('id',$category_id)->exists()){ //for double click problem
            Category::find($category_id)->delete();
            Product::where('category_id' , $category_id)->delete();
            }
            return back()->with('category_delete', 'Category Deleted Successfully');
            //echo Category::where('id',$category_id)->delete( );
    }
    function categoryalldelete(){
        Category::whereNull('deleted_at')->delete(); 
        // Category::truncate();
        return back();
    }
    function categoryedit($category_id){
        $category_info = Category::find($category_id);
        return view('category.edit',compact('category_info'));
    }
    function categoryeditpost(Request $req){
        if($req->category_name == Category::find($req->category_id)->category_name){
            return back()->withErrors('why same');
        }
        $req->validate(
            [
                'category_name' => ['required','string','unique:categories,category_name']
            ]);
        Category::find($req->category_id)->update([
            'category_name' => $req->category_name
        ]);
        return redirect('category')->with('category_update', 'Category '.$req->category_name.' Updated Successfully');;
    }
    function categoryrestore($category_id){ 
        Category::onlyTrashed()->where('id',$category_id)->restore();
        Product::onlyTrashed()->where('category_id',$category_id)->restore();
        return back();
    }
    function categoryforcedelte($category_id){ 
        Category::onlyTrashed()->where('id',$category_id)->forceDelete();
        return back();
    }
    function categoryrestoreall (){ 
        Category::onlyTrashed()->restore();
        return back();
    }
    function categoryforcedelteall (){ 
        Category::onlyTrashed()->forceDelete();
        return back();
    }
    function category_check_delete (Request $req ){ 
        if (isset($req->category_id)) {
            foreach ($req->category_id as $single_category_id) {
                Category::find($single_category_id)->delete();
            }
            return back();
        }
        else{
            echo 'donai';
        }
    }
} 
