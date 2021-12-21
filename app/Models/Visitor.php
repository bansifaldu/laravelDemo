<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class Visitor extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    
          protected $guard = 'visitor';
         protected $table = 'visitor';
        protected $fillable = [
            'name', 'email', 'password','email_verified_at','email_verification_token'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
}
