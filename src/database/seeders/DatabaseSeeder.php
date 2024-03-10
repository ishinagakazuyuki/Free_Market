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
        \App\Models\item::factory(20)->create();
        \App\Models\comment::factory(10)->create();
        \App\Models\mylist::factory(10)->create();
    }
}
