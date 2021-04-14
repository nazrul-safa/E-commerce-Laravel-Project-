<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\carbon;
class SubcategoryController extends Controller
{
    function subcategory(){
        $categories = Category::all();
        return view('subcategory.index',compact('categories'));
    }
    function subcategory_post(Request $req){

        Subcategory::insert([
            'category_id' =>  $req->category_id,
            'subcategory_name' =>  $req->subcategory_name,
            'created_at' =>  Carbon::now()
        ]);
        return back();
    }
}