<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(StateSeeder::class);
        $this->call(StaffSeeder::class);
        \App\Models\User::factory(1)->create([
            'email'=>'someone@example.com',
        ]);
    }
}
