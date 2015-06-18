<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKehadiransTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kehadirans', function(Blueprint $table)
		{
			$table->integer('rapat_id')->unsigned();
			$table->integer('pejabat_id')->unsigned();
			$table->boolean('hadir');
			$table->string('keterangan');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kehadirans');
	}

}
