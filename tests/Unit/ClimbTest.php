<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Climb;

class ClimbTest extends TestCase
{
    /**
     * A Climb can be created and each property set successfully
     *
     * @return void
     */
    public function testClimbCreatedSuccessfully()
    {
        $test_climb = Climb::create([
            'name' => 'Acupulco Gold',
            'description' => 'This is a test description.',
            'color' => 'yellow',
            'grade' => '5.14',
            'setter_id' => 1,
        ]);

        $this->assertEquals($test_climb->name, 'Acupulco Gold');
        $this->assertEquals($test_climb->description, 'This is a test description.');
        $this->assertEquals($test_climb->color, 'yellow');
        $this->assertEquals($test_climb->grade, '5.14');
        $this->assertEquals($test_climb->setter_id, 1);
    }

    /**
     * After a climb is created, we can successfully convert its grade
     * 
     * @return void
     */
    public function testClimbGradeConvertedSuccessfully()
    {
        $test_climb = Climb::create([
            'name' => 'White Rhino',
            'description' => 'This is a test description.',
            'color' => 'white',
            'grade' => '5.14',
            'setter_id' => 1,
        ]);

        $converted_grade = Climb::convertGrade( $test_climb->grade );

        $this->assertEquals($converted_grade, '5.11a');
    }
}