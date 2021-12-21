<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_permissions', function (Blueprint $table) {
             $table->bigInteger('user_id')->unsigned();
             $table->bigInteger('permission_id')->unsigned(); 
 

             $table->index('user_id');
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->index('permission_id');
             $table->foreign('permission_id')->references('id')->on('permission')->onDelete('cascade');

             


            //SETTING THE PRIMARY KEYS
            $table->primary(['user_id','permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_permissions');
        $table->dropForeign('user_id');  
        $table->dropForeign('permission_id');  
    }
}
