<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactNameColumnsToApplications extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('applications', function($t)
        {
            $t->string('contact_firstname', 70)->nullable();
            $t->string('contact_lastname', 70)->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('applications', function($t)
        {
            $t->dropColumn('contact_firstname');
            $t->dropColumn('contact_lastname');
        });
	}

}
