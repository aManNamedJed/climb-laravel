<?php

namespace Tests\Feature\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Location;

class LocationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Tests the basic creation of a Location model
     */
    public function testLocationCanBeCreatedSuccessfully()
    {
        $test_location = Location::create([
            'company_id' => 1,
            'address_id' => 1
        ]);

        $this->assertEquals($test_location->company_id, 1);
    }

    /**
     * Tests that we can use the company property on a location to retrieve its Company model
     */
    public function testLocationBelongsToCompany()
    {
        $test_company = factory(\App\Company::class)->create();
        $test_location = $test_company->locations()->save( factory(\App\Location::class)->make() );

        $this->assertEquals( $test_location->company->name, $test_company->name);
    }
}
