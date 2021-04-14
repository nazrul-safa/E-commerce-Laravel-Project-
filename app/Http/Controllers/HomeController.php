<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
             $users = User::all();
          // $users = User::latest()->get();
          //$users = User::latest()->paginate(5); 
          //$users = User::limit(5)->get();
        return view('home', compact('users'));
    }
}
