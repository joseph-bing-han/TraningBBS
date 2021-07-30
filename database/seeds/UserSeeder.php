<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::cleanDirectory(public_path('storage/avatar/'));
        factory(\App\Models\User::class, 119)->create();
    }
}
