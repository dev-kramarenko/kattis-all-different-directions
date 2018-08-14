<?php
/**
 * Created by PhpStorm.
 * User: Aleksandr Kramarenko
 * Date: 14-Aug-18
 * Time: 11:46
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Directions;

final class Test extends TestCase
{
    /** @test */
    public function two_inputs()
    {
        $nav = new Directions;

        $nav->add("30 40 start 90 walk 5");
        $nav->add("40 50 start 180 walk 10 turn 90 walk 5");

        $this->assertEquals("30.00000 45.00000 0.00000", $nav->calc(), "Something wrong");
    }

    /** @test */
    public function multiple_inputs()
    {
        $nav = new Directions;

        $nav->add("87.342 34.30 start 0 walk 10.0");
        $nav->add("2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60");
        $nav->add("58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5");

        $this->assertEquals("97.15467 40.23341 7.63097", $nav->calc(), "Something wrong");
    }
}