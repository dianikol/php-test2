<?php

namespace Tests\Unit;

use App\Sakis;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SakisTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $name = Sakis::getName();

        $this->assertEquals('sakis', $name);
    }
}
