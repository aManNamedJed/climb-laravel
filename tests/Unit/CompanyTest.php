<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Company;

class CompanyTest extends TestCase
{
    use WithFaker;

    /**
     * A company can be created with all necessary properties
     *
     * @return void
     */
    public function testCompanyCanBeCreatedSuccessfully()
    {
        $test_company = Company::create([
            'name' => 'Earth Treks',
            'phone' => '(303) 333-3333',
            'email' => 'test@testclimb.com',
            'contact_name' => 'John Smith'
        ]);

        $this->assertEquals( $test_company->name, 'Earth Treks');
        $this->assertEquals( $test_company->phone, '(303) 333-3333');
        $this->assertEquals( $test_company->email, 'test@testclimb.com');
        $this->assertEquals( $test_company->contact_name, 'John Smith');
    }

    public function testCompanyCanHaveLocations()
    {
        $test_company = factory(\App\Company::class)->create();
        $test_location = $test_company->locations()->save( factory(\App\Location::class)->make() );

        $this->assertTrue($test_company->locations->contains($test_location));
    }
}
