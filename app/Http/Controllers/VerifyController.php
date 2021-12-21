<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
 



class VerifyController extends Controller
{
    public function VerifyEmail($token = null)
    {
    	if($token == null) {

    		session()->flash('message', 'Invalid Login attempt');

    		return redirect()->route('visitor_login');

    	}

       $visitor = Visitor::where('email_verification_token',$token)->first();
        if($visitor == null ){

       	session()->flash('message', 'Invalid Login attempt');

        return redirect()->route('visitor_login');
       }
       
        
    //    auth('visitor')->attempt(['email' => $visitor['email'], 'password' => $decrypted]);
       $vvv= DB::table('visitor')->where('email', $visitor['email'])->update(array('email_verified' => 1,'email_verified_at' =>Carbon::now(),'email_verification_token' =>''));  

    //    $visitor->update([
        
    //     'email_verified' => 1,
    //     'email_verified_at' => Carbon::now(),
    //     'email_verification_token' => ''

    //    ]);
       
       	session()->flash('message', 'Your account is activated, you can log in now');

        return redirect()->route('visitor_login');

    }

}
