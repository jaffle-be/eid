<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImportingFieldsToApplication extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('applications', function(Blueprint $table)
		{
			$table->boolean('is_csv_import')->default(0);
            $table->string('csv_import_category');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('applications', function(Blueprint $table)
		{
			$table->removeColumn('is_csv_import');
            $table->removeColumn('csv_import_category');
		});
	}

}