<?php


use Illuminate\Database\Migrations\Migration;

class CreateAdministratorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('administrator', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->boolean('banned')->default(False);
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
		Schema::drop('administrator');
	}

}
