<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyToRolesPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles_permission', function (Blueprint $table) {
            $table->index('role_id');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            $table->index('permission_id');
            $table->foreign('permission_id')->references('id')->on('permission')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles_permission', function (Blueprint $table) {
            $table->dropForeign('roll_id');  
            $table->dropForeign('permission_id');  
        });
    }
}
