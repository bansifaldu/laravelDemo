<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
 
class User_role extends Model
{
    protected $table = 'user_role';

    protected $fillable = [
        'role_id' ,
        'user_id'        
     ];
     
   
    
     
}
