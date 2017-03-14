<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name'     => 'JP Caparas',
                'email'    => 'jp@pixelfusion.co.nz',
                'password' => Hash::make('secret'),
            ]
        );
    }
}
