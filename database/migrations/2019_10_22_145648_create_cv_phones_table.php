<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCvPhonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_phones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cv_id');
			$table->string('number', 191);
			$table->timestamps();
			$table->string('country_code', 191);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cv_phones');
	}

}
