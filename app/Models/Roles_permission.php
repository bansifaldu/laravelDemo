<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
 
class Roles_permission extends Model
{
    protected $table = 'roles_permission';

    protected $fillable = [
        'role_id' ,
        'permission_id'        
     ];
     function get_permission($id){
        $permbyrole = DB::table('roles_permission')->select('permission_id')->where('role_id', $id)->pluck('permission_id');

        
        return $permbyrole;

     }
    public function role()
    {
        return $this->belongsToMany('App\Models\Role','role_id');
    } 
   
    
     
}
