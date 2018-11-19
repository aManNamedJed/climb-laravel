<?php

use Illuminate\Database\Seeder;

class ClimbsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Climb::class, 50)->create();
    }
}
