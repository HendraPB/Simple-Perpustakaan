<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rents', function(Blueprint $table)
		{
			$table->foreign('status_id', 'rents_ibfk_1')->references('id')->on('statuses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('book_id', 'rents_ibfk_2')->references('id')->on('books')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'rents_ibfk_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rents', function(Blueprint $table)
		{
			$table->dropForeign('rents_ibfk_1');
			$table->dropForeign('rents_ibfk_2');
			$table->dropForeign('rents_ibfk_3');
		});
	}

}
