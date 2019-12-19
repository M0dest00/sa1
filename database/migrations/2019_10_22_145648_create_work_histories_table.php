<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('work_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cv_id');
			$table->string('job_title', 191);
			$table->string('description', 191)->nullable();
			$table->string('company_name', 191);
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
		Schema::drop('work_histories');
	}

}
