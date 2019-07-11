<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//--------------= Post Table Schema
		Schema::create('posts', function (Blueprint $table) {
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->text ('title')->nullable();
			$table->text ('post')->nullable();
			$table->text ('back_post')->nullable();
			$table->text ('cover')->nullable();
			$table->text ('photo')->nullable();
			$table->timestamp('published_at');
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
		//--------------= Drop Post Table
		Schema::dropIfExists('posts');
	}
}
