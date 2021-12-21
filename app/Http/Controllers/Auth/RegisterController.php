<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Mail\VerificationEmail;
use App\Models\Role;
use App\Models\User;
use App\Models\User_role;
use App\Models\Visitor;
use Notification;
use App\Notifications\MyFirstNotification;
use App\Providers\RouteServiceProvider;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

 
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    function register_con(){
        $role = Role::where('name', '!=' , 'superadmin')->get();
        
        //  echo "<pre>else"; print_r($role); exit;

        if(empty($role)){
             $role=array();
        }
        return view('auth.register', compact('role'));
    }
    public function showVisitorRegisterForm()
    {
        return view('auth.visitorregister');
    }
    /**
     * Where to redirect users after registration.
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
        // $this->middleware('guest');
        // $this->middleware('guest:user');
        // $this->middleware('guest:visitor');
 

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
 
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        dispatch(new SendEmailJob($user))->delay(70);
         $details = [
            'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification from ItSolutionStuff.com',
            'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            
        ];
  
        Notification::send($user, new MyFirstNotification($details));  
          // $id = $user->id();  
        // echo "<pre>id"; print_r($id); exit;
        // echo "<pre>user"; print_r($user->id); exit;
        // $id = DB::table('users')->insertGetId(
        //     [
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'password' => Hash::make($data['password']),
        //     ]
        // );
        if(!empty($data['role_id'])){
            foreach($data['role_id'] as $key=>$val){
                $role_ids = User_role::insert([
                  'role_id' => $val,
                  'user_id' => $user->id,
                ]);
            }
        }
            return $user;
        
    }
    function varifyemail(Request $request) {
        if ($request->input('email') !== '') {
            if ($request->input('email')) {
                $rule = array('email' => 'Required|email|unique:users');
                $validator = Validator::make($request->all(), $rule);
            }
            if (!$validator->fails()) {
                die('true');
            }
        }
        die('false');
    }
     function createVisitor(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:visitor'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

         
        $visitor = Visitor::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'email_verification_token' => Str::random(32)
        ]);

        \Mail::to($visitor->email)->send(new VerificationEmail($visitor));

        session()->flash('message', 'Please check your email to activate your account');
       
        return redirect()->back();
        // auth('visitor')->attempt(['email' => $request->email, 'password' => $request->password]);
        // echo "<pre>id"; print_r($_POST); exit;

        // return redirect()->intended('/visitordashboard');
    }

    
    
}
