<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOpensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('opens', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('role_id')->index('opens_role_id');
			$table->bigInteger('menu_id')->index('opens_menu_id');
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
		Schema::drop('opens');
	}

}
