<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Roles_permission;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use DataTables;
use DB;

class RoleController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->role = new Role();
        $this->roles_permission = new Roles_permission();
    }

    
    public function index(Request $request)
    {
      $user = Auth::user();
      return view('role.list', compact('request'));
    }
     
    public function getrole(Request $request)
    {
      if($request->user()->can('create-tasks')){
        $permission="1";
      }else{
        $permission="0";
      }
         if ($request->ajax()) {
             $data = Role::latest()->get();
             
            //  $data['per']=$permission;
              //  echo "<pre>else"; print_r($data['permission']); exit;
             return Datatables::of($data)
                ->addIndexColumn()
              //   ->addColumn('status', function($data){
              //     $statusBtn = '<input id="toggle-demo" class="my_switch" type="checkbox" name="status"   checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">';
              //     return $statusBtn;
              // })
              
                ->addColumn('action', function($data){
                    $actionBtn = null;
                  // if('1' == '1'){
                    // if (\Auth::user()->can('edit-tasks')) {
                      $actionBtn = '<a href="/role/role_edit/'.$data->id.'"  id="getEditUserData" class="edit btn btn-success btn-sm">Edit</a> <a href="/role/deleteData/'.$data->id.'"  class="delete btn btn-danger btn-sm">Delete</a>';
                    // }  
                   return $actionBtn;
                })
                
                ->rawColumns(['action'])
                //  ->rawColumns(['action','status'])
                ->make(true);
        }
    }
    public function create_role()
    { 
      $permission = Permission::all();
      // echo "<pre>else"; print_r($permission); exit;
       return view('role.role_create', compact('permission'));

    }
    public function create_role_save(Request $request)
      { 
        // echo "<pre>  "; print_r($request->all()); exit;
        $this->validate($request, [
          'name' => ['required', 'string', 'max:255'],
          'slug' => ['required', 'string', 'max:255'], 
        ]);
        if(isset($request->status) && $request->status == 'on'){
          $_POST['status']="active";
        }else{
          $_POST['status']="inactive";
        }

        /////////////////////////////////////
        $role = new Role();
        $role->name = $_POST['name'];
        $role->status = $_POST['status'];
        $role->slug = $_POST['slug'];
        $role->save();
        // echo "<pre>else"; print_r($role); exit;
        $roles_permission = new Roles_permission();
        if(!empty($_POST['permission'])){
          foreach($_POST['permission'] as $key=>$val){
            $permissionId[] =  ['permission_id' => $val];
          }
          $role->roles_permission()->createMany($permissionId);
        }
        /////////////////////////////////////

        /////////////////////////////////////
        // $roleId = Role::create([
        //   'name' => $_POST['name'],
        //     'status' => $_POST['status'],
        // ]);

        
        // foreach($_POST['permission'] as $key=>$val){
        //   $permissionId[]=new Roles_permission(array('permission_id' => $val));
        // }
        // $roleId->roles_permission()->saveMany($permissionId);
/////////////////////////////////////////////////////



        // foreach($_POST['permission'] as $key=>$val){
        //     $permissionId = Roles_permission::insert([
        //       'role_id' => $roleId,
        //       'permission_id' => $val,
        //     ]);
        // }
        
         
        //    echo "<pre>  "; print_r($request->all()); exit;
         
         return redirect()->route('role.role_management')
            ->with('success', 'Role created successfully');

      }
      public function role_edit($id)
      { 
        $data=$this->role->get_role_edit($id); 
        $role=$data[0];
        $permission = Permission::all();
        $get_permission = Role::with('roles_permission')->find($id)->roles_permission->pluck('permission_id');
        //  echo "<pre>  ccc"; print_r($get_permission); exit;
        // $get_permission=$this->roles_permission->get_permission($id); 
        $get_permission = json_decode(json_encode($get_permission), true);
        // $get_permission_array= implode(',',$get_permission);
        $get_permission_array = array_values($get_permission);
        // echo "<pre>  "; print_r($array); exit;
        return view('role.role_edit', compact('role','permission','get_permission_array'));

      }
      public function role_edit_save(Request $request)
      { 
        if(isset($request->status) && $request->status == 'on'){
          $_POST['status']="active";
        }else{
          $_POST['status']="inactive";
        }
        // echo "<pre>  "; print_r($request->status); exit;
        $request->validate([
          'name' => ['required', 'string', 'max:255'],
        ]);
        $find_role=  Role::find($_POST['id']); 
        $vvv= DB::table('role')->where('id', $_POST['id'])->update(array('name' => $_POST['name'],'status' =>$_POST['status'],'slug' =>$_POST['slug']));  
        // $get_permission = Role::with('roles_permission')->find($_POST['id'])->roles_permission->pluck('id');
        Roles_permission::where('role_id', $_POST['id'])->delete(); 

        
        
        $roles_permission = new Roles_permission();
        if(!empty($_POST['permission'])){
          foreach($_POST['permission'] as $key=>$val){
            $permissionId[] =  ['permission_id' => $val];
          }
          $find_role->roles_permission()->createMany($permissionId);
        }
        
        // $roles = Role::find($_POST['id'])->roles_permission->pluck('id');
        // $rolesarr = json_decode(json_encode($roles), true);
        // $roles_permission = new Roles_permission();
        // foreach($_POST['permission'] as $key=>$val){
        //   $roles->roles_permission()->attach(array('permission_id' =>$val));
        // }
        // $role->roles_permission()->createMany($permissionId);
        // $user->roles()->attach(1, array('expires' => $expires));
         
            // echo "<pre>  "; print_r($rolesarr); exit;
         
         return redirect()->route('role.role_management')
            ->with('success', 'Role updated successfully');

      }
      public function deleteData($id)
      {
        DB::table('role')->where('id', $id)->delete();
        return redirect()->route('role.role_management')
        ->with('success', 'Role deleted successfully');
          
      }
      public function changestatusid()
      {
        
        $this->role->update_status($_POST); 
         
      }
}
