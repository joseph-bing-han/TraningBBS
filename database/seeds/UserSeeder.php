<?php

use App\Models\User;
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
        if(!File::exists(storage_path('app/public/avatar/'))){
            File::makeDirectory(storage_path('app/public/avatar/'));
        }
        File::cleanDirectory(storage_path('app/public/avatar/'));
        factory(User::class, 119)->create();
    }
}
