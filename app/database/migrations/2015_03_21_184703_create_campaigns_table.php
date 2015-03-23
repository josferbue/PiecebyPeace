<?php

use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->binary('image');
			$table->date('startDate');
			$table->date('finishDate');
			$table->integer('visits')->unsigned();
			$table->string('link');
			$table->integer('maxVisits')->unsigned();
			$table->integer('promotionDuration')->unsigned();
			$table->integer('ngo_id')->unsigned()->index();
			$table->foreign('ngo_id')->references('id')->on('ngo')->onDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campaign');
	}

}
