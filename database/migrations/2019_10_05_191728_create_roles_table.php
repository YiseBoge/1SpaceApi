<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('description');
            $table->string('remark')->nullable();

            $table->boolean('can_add_user')->default(false);
            $table->boolean('can_edit_user')->default(false);
            $table->boolean('can_delete_user')->default(false);
            $table->boolean('can_activate_user')->default(false);
            $table->boolean('can_deactivate_user')->default(false);
            $table->boolean('can_assign_user_admin')->default(false);
            $table->boolean('can_generate_user_cv')->default(false);
            $table->boolean('can_generate_user_report')->default(false);

            $table->boolean('can_assign_organogram_admin')->default(false);
            $table->boolean('can_add_department')->default(false);
            $table->boolean('can_edit_department')->default(false);
            $table->boolean('can_delete_department')->default(false);
            $table->boolean('can_add_position')->default(false);
            $table->boolean('can_edit_position')->default(false);
            $table->boolean('can_delete_position')->default(false);
            $table->boolean('can_add_professional_role')->default(false);
            $table->boolean('can_edit_professional_role')->default(false);
            $table->boolean('can_delete_professional_role')->default(false);

            $table->boolean('can_assign_project_admin')->default(false);
            $table->boolean('can_add_project')->default(false);
            $table->boolean('can_edit_project')->default(false);
            $table->boolean('can_delete_project')->default(false);
            $table->boolean('can_evaluate_project')->default(false);
            $table->boolean('can_generate_project_report')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
