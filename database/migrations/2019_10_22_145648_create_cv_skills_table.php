<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCvSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_skills', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cv_id');
			$table->integer('skill_id');
			$table->timestamps();
			$table->string('description', 191);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cv_skills');
	}

}
