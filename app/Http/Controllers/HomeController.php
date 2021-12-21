<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
         $user = $request->user(); 

        //  dd($user->hasRole('developer'));

        //   echo "<pre>"; print_r($user->hasRole('developer')); 
        // echo "<pre>"; print_r($user->hasRole('admin','editor'));exit;
        return view('home');
    }
}
