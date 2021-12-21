<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visitor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('guest:user')->except('logout');
        // $this->middleware('guest:visitor')->except('logout');
    }
    public function visitorLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
         // bcrypt($request['password']
        // if (auth()->guard('visitor')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        // {
        //     echo "sssss";exit;
        //     $user = auth()->guard('admin')->user();
        //     dd($user);
        // }
        $user = Visitor::where('email',$request->email)->first();
         if(isset($user->email_verified) && $user->email_verified == 1){
             if (Auth::guard('visitor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                // echo "<pre>cccc"; print_r($request->all()); exit;

    
                return redirect()->intended('/visitordashboard');
            }
        }
       
        // echo "<pre>vvv"; print_r($request->all()); exit;
        return back()->withErrors(['Error', 'Email or Password are invalid']);

         // return back()->withInput($request->only('email', 'remember'));
    }
    public function logoutvisitor(Request $request)
    {
        // echo "<pre>vvv"; print_r($request->session()); exit;
        //   Auth::logout();
         // echo "dddd"; exit;
        //  $request->session()->flush();

        Auth::guard('visitor')->logout();
        // $request->session()->getHandler()->destroy($request->session()->getId());
        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/');
    }
    public function admin_logout(Request $request)
    {
        // $request->session()->flush();
        // $request->session()->getHandler()->destroy($request->session()->getId());
        Auth::logout();

        // echo "<pre>vvv"; print_r($request->session()); exit;

        // Auth::guard('user')->logout();
        // $request->session()->getHandler()->destroy($request->session()->getId());
        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/');
    }
    
}
