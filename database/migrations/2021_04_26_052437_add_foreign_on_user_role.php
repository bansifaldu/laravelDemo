<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignOnUserRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->index('id');
        //     $table->foreign('id')->references('user_id')->on('user_role')->onDelete('cascade');
        // });
        Schema::table('user_role', function (Blueprint $table) {
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('role_id');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_role', function (Blueprint $table) {
            $table->dropForeign('user_id');  
            $table->dropForeign('role_id');  
        });

        
    }
}
