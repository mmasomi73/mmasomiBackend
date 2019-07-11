<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('musics', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->text('src');
			$table->string('title')->nullable();
			$table->string('artist')->nullable();
			$table->string('cover')->nullable();
			$table->timestamps();
		});
		Schema::create('music_listens', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('music_id');
			$table->unsignedBigInteger('listen');

			$table->foreign('music_id')->references('id')->on('musics');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('music_listens');
		Schema::dropIfExists('musics');
	}
}
