<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_roles', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('user_id')->default(0);

            $table->boolean('read_able');
            $table->boolean('write_able');
            $table->boolean('adjust_able');
            $table->boolean('remove_able');
            $table->boolean('approve_able');
            $table->boolean('cancel_able');
            $table->boolean('status')->default(true);

            $table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('update_date')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('row_create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('row_update_date')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index([
                'id',
                'role_id',
                'permission_id',
                'user_id',
            ], 'admin_role_permission_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_role_permission');
    }
}
