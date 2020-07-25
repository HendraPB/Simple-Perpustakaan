<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rents', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('user_id')->index('user_id');
			$table->bigInteger('book_id')->index('book_id');
			$table->bigInteger('status_id')->index('status_id');
			$table->date('start');
			$table->date('end');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rents');
	}

}
