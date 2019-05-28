<?php

use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Company::class, 10)->create()->each(function($company){
            
            factory(\App\Location::class, 5)->create()->each(function($location){
                $location->address()->save( factory(\App\Address::class)->create() );
            });

            $setters = factory(\App\User::class, 5)->create(['role' => 'setter'])->each(function($setter, $company){
                $setter->companies()->attach($company);
            });

            foreach( $setters as $setter ) {
                $climbs = factory(\App\Climb::class, 5)->create(['setter_id' => $setter->id]);

                foreach( $climbs as $climb ) {
                    $climb->createLabel();
                    $climbers = factory(\App\User::class, 10)->create(['role' => 'climber']);
                    foreach( $climbers as $climber) {
                        $climber->attempts()->saveMany( factory(\App\Attempt::class, 3)->create(['user_id' => $climber->id, 'climb_id' => $climb->id] ) );
                        $climber->companies()->attach($company);
                    }
                }
            }
        });
    }
}
