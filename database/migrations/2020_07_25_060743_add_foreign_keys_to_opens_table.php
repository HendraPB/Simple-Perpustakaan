<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOpensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('opens', function(Blueprint $table)
		{
			$table->foreign('role_id', 'opens_ibfk_1')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('menu_id', 'opens_ibfk_2')->references('id')->on('menus')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('opens', function(Blueprint $table)
		{
			$table->dropForeign('opens_ibfk_1');
			$table->dropForeign('opens_ibfk_2');
		});
	}

}
