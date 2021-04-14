<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMessages;

class ContactController extends Controller
{
    function contact(){
        return view('contact'); 
        }
    function contact_post(Request $req){
        $details= [
            'fname' =>$req->fname,
            'email' =>$req->email,
            'subject' =>$req->subject,
            'msg' =>$req->msg,
        ];
        Contact::insert($req->except('_token') +[
        'created_at' => Carbon::now()
        ]);
        Mail::to('nazrul.safa@gmail.com')->send(new SendMessages($details));
        return back()->with('mesg_send', 'Message Send Successfully');
    }
}
