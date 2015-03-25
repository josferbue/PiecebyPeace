<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company', function($table)
		{
			//Actor Abstract
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->boolean('banned');



			$table->string('sector');
			$table->string('description');
			$table->string('phone');
			$table->binary('logo')->nullable();
			$table->boolean('active')->unsigned()->default(false);



			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users');



		});


	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('company');
	}

}
