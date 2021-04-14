<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Carbon\Carbon;

class FaqController extends Controller
{
     public function __construct()
          {
          $this->middleware('auth');
          }
     function faq(){
          $faq_data = Faq::all();
          return view('faq', compact('faq_data'));
          }
     function faq_post(Request $req){
          $req->validate(
          [
          'qus' => ['required','string'],
          'ans' => ['required','string']
          ]);
          
          Faq::insert($req->except('_token') +[
          'created_at' => Carbon::now()
          ]);
          return back();
     }
     function faq_delete($faq_id){
     if(Faq::where('id',$faq_id)->exists()){ //for double click problem
     Faq::find($faq_id)->delete();
     }
     return back();
     }
}