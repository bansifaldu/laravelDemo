<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
class LanguageTranslationController extends Controller
{
    public function index(Request $request){
         
          \Session::put( 'my_locale', $request->language );


        return back();
    }
}
