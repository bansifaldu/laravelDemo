<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use App\Permissions\HasPermissionsTrait;
use Laravel\Passport\HasApiTokens;

 
class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;
    use HasPermissionsTrait;
 
    protected $guard = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function update_userinfo($data,$id){
        $data = DB::table('users')
                ->where('id', $id)
               ->update(['name' =>$data['name'],'email' =>$data['email']]);
        return $data;
    }  
    public function get_usermagagement_edit($id){
        $users = DB::table('users')
        ->where('id', $id)
        ->get();
        return $users;
    } 
    public function update_usermagagement($data){
        $user = DB::table('users')
                ->where('id', $data['id'])
               ->update(['name' =>$data['name'],'email' =>$data['email']]);
        return $user;
    } 
    public function get_user_type($id){
        $role_id = DB::table('user_role')
                ->where('user_id', $id)
                ->pluck('role_id');

                if(!empty($role_id)){
                    $role_id = json_decode(json_encode($role_id), true);
                    $get_user_role_id_array = array_values($role_id);
                    $role_name = DB::table('role')->whereIn('id', $get_user_role_id_array)->pluck('slug');
                    if(!empty($role_name)){
                        $role_name = json_decode(json_encode($role_name), true);
                        $get_user_role_name_array = array_values($role_name);
                    }
                    return $get_user_role_name_array;

                }
                
                 // echo "<pre>ccc"; print_r($user);exit;

                 return false;  
         
         
    } 
}
