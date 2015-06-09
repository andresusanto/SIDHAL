<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePejabatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pejabats', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->char('organisasi', 1);
			$table->string('jabatan');
			$table->string('nama');
			$table->string('email');
			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pejabats');
	}

}
