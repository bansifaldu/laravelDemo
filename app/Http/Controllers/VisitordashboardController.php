<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Visitor;
class VisitordashboardController extends Controller
{
    public function __construct()
    {
        // echo "<pre>id"; print_r($_POST); exit;

      
        $this->middleware('auth:visitor');
    }
    public function index(Request $request)
    {
        // dd(auth('visitor')->user());
        // echo "ddddd";exit;
        // $username = auth()->guard($guard)->getName();
         $user = Auth::guard('visitor')->user();
        // echo "<pre>"; print_r($user); exit;
        //  dd($user->hasRole('developer'));

         return view('frontend.visitordashboard');
    }
     
}
