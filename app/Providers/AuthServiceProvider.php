<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\User_role;
use Laravel\Passport\Passport; // add this 


// use App\Models\Permission;
// use App\Models\User;
// use Illuminate\Support\Facades\Blade;
// use Illuminate\Support\Facades\Gate;
// use Illuminate\Support\ServiceProvider;
// use Illuminate\contracts\Auth\Access\Gate as Gatecontract;

class AuthServiceProvider extends ServiceProvider
{
    public function __construct()
    {
         $this->users = new User();
     }
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
          'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    // public function boot(GateContract $gate)
    // public function boot()
    // {
    //     echo "hii"; exit;
    //     $this->registerPolicies($gate);

    //     $gate->define('isAdmin', function($user){
    //         return $user->user_type == 'admin';
    //     });

    //     //
    // }
    public function boot()
    {
        
        $this->registerPolicies();
        
                Passport::routes(); // Add this

        Gate::define('user', function (User $user) {
            $user_type=$this->users->get_user_type($user->id); 
            // echo "<pre>"; print_r($user_type);exit;
            $user_data=$user;
            $user_data->user_type=$user_type;
            // foreach($user_data->user_type as $key=>$val){
            //     return $val == 'superadmin';
            // }
            if(in_array('user',$user_data->user_type)){
                return 'user';
            }
        });
        Gate::define('admin', function (User $user) {
            $user_type=$this->users->get_user_type($user->id); 
            $user_data=$user;
            $user_data->user_type=$user_type;
            if(in_array('admin',$user_data->user_type)){
                return 'admin';
            }
        });
        Gate::define('customer', function (User $user) {
            $user_type=$this->users->get_user_type($user->id); 
            $user_data=$user;
            $user_data->user_type=$user_type;
                if(in_array('customer',$user_data->user_type)){
                     return 'customer';
                }
        });
        
    }
}
