<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserwelcomeController extends Controller
{
    
    public function index(Request $request)
    {
        // $user = $request->user(); 

        //  dd($user->hasRole('developer'));

        //   echo "<pre>"; print_r($user->hasRole('developer')); 
        // echo "<pre>"; print_r($user->hasRole('admin','editor'));exit;
        return view('frontend.index');
    }
    public function visitor_login(Request $request)
    {
         
        return view('frontend.login');
    }
    public function visitor_register(Request $request)
    {
         
        return view('frontend.register');
    } 
}
