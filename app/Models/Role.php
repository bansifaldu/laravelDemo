<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
 
class Role extends Model
{
    protected $table = 'role';

    protected $fillable = [
        'name',
        'status',
        'slug',
     ];
   
    
    public function get_role_edit($id){
        $role = DB::table('role')
        ->where('id', $id)
        ->get();
        return $role;
    } 
    public function update_role($data){
        // echo "<pre>  "; print_r($data); exit;
        $role = DB::table('role')
                ->where('id', $data['id'])
               ->update(['name' =>$data['name'],'status' =>$data['status']]);
        return $role;
    } 
    public function update_status($data){
        // echo "<pre>  "; print_r($data); exit;
        $role = DB::table('role')
                ->where('id', $data['id'])
               ->update(['status' =>$data['status']]);
        return $role;
    } 
    function get_role($id){
        $permbyrole = DB::table('user_role')->where('user_id', $id)->pluck('role_id');

        
        return $permbyrole;

     }
    public function roles_permission()
    {
        return $this->hasMany('App\Models\Roles_permission');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    } 
    // authentication
    public function permissions() {

        return $this->belongsToMany(Permission::class,'roles_permission');
            
    }
     
    public function users() {
     
        return $this->belongsToMany(User::class,'user_role');
            
     }
     
}
