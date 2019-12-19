<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEducationHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('education_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cv_id');
			$table->string('education_institution', 191);
			$table->string('description', 191)->nullable();
			$table->date('from');
			$table->date('to');
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
		Schema::drop('education_histories');
	}

}
