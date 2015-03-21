<?php


use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->binary('image');
			$table->string('address');
			$table->string('city');
			$table->string('zipCode');
			$table->integer('maxVolunteers');
			$table->date('startDate');
			$table->date('finishDate');
			$table->timestamp();
			$table->integer('ngo_id')->unsigned()->index()->nullable();
			$table->integer('company_id')->unsigned()->index()->nullable();
			$table->foreign('ngo_id')->references('id')->on('ngo')->onDelete('cascade');
			$table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project');
	}

}
