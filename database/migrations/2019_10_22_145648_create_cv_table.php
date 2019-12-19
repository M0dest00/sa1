<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCvTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('first_name', 191);
			$table->string('last_name', 191);
			$table->date('date_of_birth');
			$table->string('nationality', 191);
			$table->integer('gender_id');
			$table->string('address', 191);
			$table->string('city_id', 191);
			$table->integer('country_id');
			$table->string('picture', 191);
			$table->boolean('driving_license_availablity');
			$table->boolean('smoker');
			$table->boolean('travel_availablity');
			$table->string('cv_pdf', 191)->nullable();
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
		Schema::drop('cv');
	}

}
