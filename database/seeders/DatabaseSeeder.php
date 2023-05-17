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
        \App\Models\User::factory(3)->create();
        \App\Models\Car::factory(5)->create();
        \App\Models\Motorcycle::factory(5)->create();
        \App\Models\Vehicle::factory(5)->create();
        \App\Models\Sale::factory(5)->create();

    }
}
