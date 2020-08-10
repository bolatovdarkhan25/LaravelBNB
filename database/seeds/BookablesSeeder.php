<?php

use Illuminate\Database\Seeder;

class BookablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Bookable::class, 25)->create();
    }
}
