<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        User::create(array(
            'email' => 'kdr@tmab.be',
            'password'=> Hash::make('23aapjeBE')
        ));



		// $this->call('UserTableSeeder');
	}

}