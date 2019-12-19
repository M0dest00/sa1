<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('email', 191)->nullable()->unique();
			$table->string('password', 191)->nullable();
			$table->string('picture', 191)->nullable();
			$table->string('api_token', 191)->nullable();
			$table->boolean('exam')->default(0);
			$table->boolean('interview')->default(0);
			$table->string('role', 191)->default('user');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('phone', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->integer('country_id')->unsigned()->nullable();
			$table->integer('re_exam')->default(0);
			$table->dateTime('start');
			$table->dateTime('end');
			$table->integer('result')->nullable();
			$table->integer('pass_limit')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
