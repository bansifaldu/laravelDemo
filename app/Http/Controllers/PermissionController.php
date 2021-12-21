<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use DataTables;
use DB;
 use App\Models\Role;
use App\Models\User;
class PermissionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->permission = new Permission();
    }

    
    public function index()
    {
      $user = Auth::user();
      return view('permission.list');
    }
     
    public function getpermission(Request $request)
    {
     
         if ($request->ajax()) {
             $data = Permission::latest()->get();
            //  echo "<pre>else"; print_r($data); exit;
             return Datatables::of($data)
                ->addIndexColumn()
              
              
                ->addColumn('action', function($data){
                    $actionBtn = '<a href="/permission/permission_edit/'.$data->id.'"  id="getEditUserData" class="edit btn btn-success btn-sm">Edit</a> <a href="/permission/deleteData/'.$data->id.'"  class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                
                ->rawColumns(['action'])
                 ->make(true);
        }
    }
    public function create_permission()
    { 
       return view('permission.permission_create');

    }
    public function create_permission_save(Request $request)
      { 
        $this->validate($request, [
          'name' => ['required', 'string', 'max:255'],
          'slug' => ['required', 'string', 'max:255'],
        ]);
        $permission = Permission::create([
            'name' => $_POST['name'],
            'slug' => $_POST['slug'],
          ]);
         
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('permission.permission_management')
            ->with('success', 'Permission created successfully');

      }
      public function permission_edit($id)
      { 
        $data=$this->permission->get_permission_edit($id); 
        $permission=$data[0];
        return view('permission.permission_edit', compact('permission'));

      }
      public function permission_edit_save(Request $request)
      { 
         
        // echo "<pre>  "; print_r($request->status); exit;
        $request->validate([
          'name' => ['required', 'string', 'max:255'],
          'slug' => ['required', 'string', 'max:255'],
        ]);
        
        $this->permission->update_permission($_POST); 
        
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('permission.permission_management')
            ->with('success', 'Permission updated successfully');

      }
      public function deleteData($id)
      {
        DB::table('permission')->where('id', $id)->delete();
        return redirect()->route('permission.permission_management')
        ->with('success', 'Permission deleted successfully');
          
      }
    //   public function Permission()
    // {   
    // $dev_permission = Permission::where('slug','create-tasks')->first();
		// $manager_permission = Permission::where('slug', 'edit-users')->first();
    // 
    // 
		// //RoleTableSeeder.php
		// $dev_role = new Role();
		// $dev_role->slug = 'developer';
		// $dev_role->name = 'Front-end Developer';
		// $dev_role->save();
		// $dev_role->permissions()->attach($dev_permission);

		// $manager_role = new Role();
		// $manager_role->slug = 'manager';
		// $manager_role->name = 'Assistant Manager';
		// $manager_role->save();
		// $manager_role->permissions()->attach($manager_permission);

		// $dev_role = Role::where('slug','developer')->first();
		// $manager_role = Role::where('slug', 'manager')->first();

		// $createTasks = new Permission();
		// $createTasks->slug = 'create-tasks';
		// $createTasks->name = 'Create Tasks';
		// $createTasks->save();
		// $createTasks->roles()->attach($dev_role);

		// $editUsers = new Permission();
		// $editUsers->slug = 'edit-users';
		// $editUsers->name = 'Edit Users';
		// $editUsers->save();
		// $editUsers->roles()->attach($manager_role);

		// $dev_role = Role::where('slug','developer')->first();
		// $manager_role = Role::where('slug', 'manager')->first();
		// $dev_perm = Permission::where('slug','create-tasks')->first();
		// $manager_perm = Permission::where('slug','edit-users')->first();

		// $developer = new User();
		// $developer->name = 'ravi faldu';
		// $developer->email = 'aaa@gmail.com';
		// $developer->password = bcrypt('11111111');
		// $developer->save();
		// $developer->roles()->attach($dev_role);
		// $developer->permissions()->attach($dev_perm);

		// $manager = new User();
		// $manager->name = 'bbb bbb';
		// $manager->email = 'bbb@gmail.com';
		// $manager->password = bcrypt('11111111');
		// $manager->save();
		// $manager->roles()->attach($manager_role);
		// $manager->permissions()->attach($manager_perm);

		
		// return redirect()->back();
    // }
      
}
