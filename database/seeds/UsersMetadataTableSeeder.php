<?php

use Illuminate\Database\Seeder;

class UsersMetadataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_metadata')->insert(
            [
                'profession'     => 'Software Developer',
                'primary_language' => 'PHP',
                'years_of_experience' => 20,
                'current_company' => 'Pixel Fusion',
                'user_id'  => 1,
            ]
        );
    }
}
