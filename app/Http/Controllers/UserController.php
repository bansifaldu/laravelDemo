<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_role;
use App\Models\Role;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use DataTables;
use DB;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->users = new User();
        $this->role = new Role();
    }

    
    public function index()
    {
    }
     
    public function user_setting()
    {
        //   echo "<pre>"; print_r($user); exit;
        $user = Auth::user();
         // $users = User::All();
        return view('user.user_setting', compact('user'));
         
     }
     public function user_setting_save()
     {
        $user = Auth::user();
        $id= $user->id;
        $this->users->update_userinfo($_POST,$id); 
        
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('home')
            ->with('success', 'User updated successfully');
          
      } 
      public function change_password()
      { 
        return view('user.change_password');

      }
      public function change_password_save(Request $request)
      { 
         if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
          // The passwords matches
 
          return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        // echo "<pre>else"; print_r($request->all()); exit;

        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        // $validation =  Validator::make($request->all(), [
        //   'password'   => 'required',
        //   'new_password'    => 'required|string|min:6|confirmed',
        // ]);
        $this->validate($request, [
          'current_password'   => 'required',
          'new_password'    => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect()->route('home')
            ->with('success', 'Password changed successfully ');
      }
      public function user_management(Request $request)
      { 

        return view('user.user_management', compact('request'));

      }
      public function getuser(Request $request)
      {
       
           if ($request->ajax()) {
               $data = User::latest()->get();
              //  echo "<pre>else"; print_r($request->all()); exit;
               return Datatables::of($data)
                  ->addIndexColumn()
                  
                  ->addColumn('action', function($data){
                      $actionBtn = '<a href="/admin/usermagagement_edit/'.$data->id.'"  id="getEditUserData" class="edit btn btn-success btn-sm">Edit</a> <a href="/admin/deleteData/'.$data->id.'"  class="delete btn btn-danger btn-sm">Delete</a>';
                      return $actionBtn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
          }
      }
      public function usermagagement_edit($id)
      { 
        $data=$this->users->get_usermagagement_edit($id); 
        $user=$data[0];
        $role = Role::all();
        // $role = Role::where('name', '!=' , 'superadmin')->get();

        $get_role=$this->role->get_role($id); 
        $get_role = json_decode(json_encode($get_role), true);

          // echo "<pre>  "; print_r($get_role); exit;
        return view('user.usermagagement_edit', compact('user','role','get_role'));

      }
      public function usermagagement_edit_save(Request $request)
      { 
        $request->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => 'required|email|unique:users,email,'.$_POST['id'],
        ]);
        DB::table('user_role')->where('user_id', $_POST['id'])->delete();
        foreach($_POST['role_id'] as $key=>$val){
          $role_ids = User_role::insert([
            'role_id' => $val,
            'user_id' => $_POST['id'],
          ]);
        }
        
        $this->users->update_usermagagement($request->all()); 
        
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('admin.user_management')
            ->with('success', 'User updated successfully');

      }
      public function deleteData($id)
      {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('admin.user_management')
        ->with('success', 'User deleted successfully');
          
      }
      public function create_user()
      { 
        $role = Role::all();
        // $role = Role::where('name', '!=' , 'superadmin')->get();
         return view('user.usermagagement_create', compact('role'));

      }
      public function create_user_save(Request $request)
      { 
        $this->validate($request, [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8'],
        ]);
       
        $user = User::create([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => Hash::make($_POST['password']),
        ]);
        foreach($_POST['role_id'] as $key=>$val){
          $role_ids = User_role::insert([
            'role_id' => $val,
            'user_id' => $user->id,
          ]);
        }
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('admin.user_management')
            ->with('success', 'User created successfully');

      }
      function varifyemail(Request $request) {
         if ($request->input('email') !== '') {
            if ($request->input('email')) {
                 $rule = array('email' => 'required|email|unique:users,email,'.$_POST['id']);
                $validator = Validator::make($request->all(), $rule);
            }
            if (!$validator->fails()) {
                die('true');
            }
        }
        die('false');
      }
      function user_create_emailveify(Request $request) {
        if ($request->input('email') !== '') {
           if ($request->input('email')) {
                $rule = array('email' => 'required|email|unique:users');
               $validator = Validator::make($request->all(), $rule);
           }
           if (!$validator->fails()) {
               die('true');
           }
       }
       die('false');
     }

       
}
