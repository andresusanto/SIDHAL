<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRapatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rapats', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('jenis_rapat');
			$table->dateTime('waktu');
			$table->string('tempat');
			$table->text('pembahasan');
			$table->string('pimpinan');
			
			$table->timestamps();
		});
		
		Schema::create('pejabat_rapat', function(Blueprint $table)
		{
			$table->integer('pejabat_id')->unsigned();
			$table->integer('rapat_id')->unsigned();
				
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rapats');
	}

}
