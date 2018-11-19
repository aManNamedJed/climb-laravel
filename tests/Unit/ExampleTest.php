<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $climb = factory(App\Climb::class)->make([
            'name' => 'Made in the Shade'
        ]);

        $this->assertTrue($climb->name == 'Made in the Shade');
    }
}
