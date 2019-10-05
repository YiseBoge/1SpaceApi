<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('role_id');
            $table->bigInteger('department_id');
            $table->bigInteger('position_id');
            $table->bigInteger('address_id');

            $table->string('personal_name');
            $table->string('father_name');
            $table->string('grand_father_name');
            $table->date('birth_date');
            $table->date('employment_date');
            $table->bigInteger('pension_id_number');
            $table->bigInteger('pension_id_number');

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
        Schema::dropIfExists('accounts');
    }
}
