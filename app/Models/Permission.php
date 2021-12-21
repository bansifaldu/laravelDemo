<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
 
class Permission extends Model
{
    protected $table = 'permission';

    protected $fillable = [
        'name','slug'       
     ];
   
    
    public function get_permission_edit($id){
        $permission = DB::table('permission')
        ->where('id', $id)
        ->get();
        return $permission;
    } 
    public function update_permission($data){
        // echo "<pre>  "; print_r($data); exit;
        $permission = DB::table('permission')
                ->where('id', $data['id'])
               ->update(['name' =>$data['name'],'slug' =>$data['slug']]);
        return $permission;
    } 

    // authentication

    public function roles() {

        return $this->belongsToMany(Role::class,'roles_permission');
            
     }
     
     public function users() {
     
        return $this->belongsToMany(User::class,'users_permissions');
            
     }
    
}
