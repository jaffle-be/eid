<?php

class UserTableSeeder extends Seeder{

    public function run()
    {
        User::create(array(
            'email' => 'thomas@jaffle.be',
            'password'=> Hash::make('thomas')
        ));
    }

} 