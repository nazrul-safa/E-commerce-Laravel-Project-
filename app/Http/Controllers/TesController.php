<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tes;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;

class TesController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    function tes(){
    $tes_data = Tes::all();
    return view('tes', compact('tes_data'));
    }
    function tes_post(Request $req){
    $req->validate(
    [
    'comment' => ['required','string'],
    'name' => ['required','string'],
    'designation' => ['required','string'],
    ]);
     
    $this->validate($req,[
    'tes_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
    $img = $req->file('tes_photo');
    $extention = $img->getClientOriginalExtension();
    $photo_name = Str::random(10).time().'.'.$extention;
    Image::make($img)->resize(600, 622)->save(public_path(path:'photo/tes/').$photo_name);
    Tes ::insert([
    'comment' => $req->comment,
    'name' => $req->name,
    'designation' => $req->designation,
    'tes_photo' => $photo_name,
    'created_at' => Carbon::now()
    ]);
    return back();
    }
    function tes_delete($tes_id){
    if(Tes::where('id',$tes_id)->exists()){ //for double click problem
    Tes::find($tes_id)->delete();
    }
    return back();
    }
}
