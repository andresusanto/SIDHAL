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
			$table->string('nama');
            $table->string('jabatan');
            $table->string('instansi');
            $table->string('alamat');
            $table->string('telepon');
			$table->string('email');
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
