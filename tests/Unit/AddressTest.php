<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    public function testAddressCanBelongToLocation()
    {
        $test_location = factory(\App\Location::class)->create();
        $test_address = factory(\App\Address::class)->make();
        $test_location->address()->save($test_address);

        $this->assertEquals($test_address->city, $test_location->address->city);
    }
}
