<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAdminsTable
 */
class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('family');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('status');
            $table->rememberToken();
            $table->timestamps();

        });

        Schema::create('admins_token', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id')->nullable()->unique();
            $table->string('token',120);
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins_token');
        Schema::dropIfExists('admins');
    }
}
