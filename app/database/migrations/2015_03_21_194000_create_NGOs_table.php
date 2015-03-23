<?php

use Illuminate\Database\Migrations\Migration;

class CreateNGOsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ngo', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->boolean('banned');
			$table->string('holderName');
			$table->string('brandName');
			$table->string('number');
			$table->integer('expirationMonth')->unsigned();
			$table->integer('expirationYear')->unsigned();
			$table->integer('cvv')->unsigned();
			$table->string('description')->unsigned();
			$table->string('phone')->unsigned();
			$table->binary('logo')->unsigned();
			$table->boolean('active')->unsigned()->default(false);
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ngo');
	}

}
