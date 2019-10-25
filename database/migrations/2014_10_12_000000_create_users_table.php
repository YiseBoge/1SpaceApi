<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('role_id');
            $table->bigInteger('department_id');
            $table->bigInteger('position_id');
            $table->bigInteger('address_id');

            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->string('personal_name');
            $table->string('father_name');
            $table->string('grand_father_name');
            $table->string('sex');
            $table->timestamp('email_verified_at')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('employment_date')->nullable();
            $table->bigInteger('pension_id_number')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
