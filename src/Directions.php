<?php
/**
 * Created by PhpStorm.
 * User: Aleksandr Kramarenko
 * Date: 14-Aug-18
 * Time: 09:34
 */

namespace App;

/**
 * Class Directions
 * @package App
 */
class Directions
{
    private $directions = array();

    /**
     * @param $str
     */
    public function add($str)
    {
        $this->directions[] = trim($str);
    }


    /**
     * @return string
     */
    public function calc()
    {
        $points = [];
        $x_summary = 0;
        $y_summary = 0;

        foreach ($this->directions as $raw_direction) {
            $parser = new Parser($raw_direction);

            $points[] = $parser->getPoint();
            $x_summary += $parser->getPoint()[0];
            $y_summary += $parser->getPoint()[1];
        }

        // calc average coordinates
        $average_coordinates = [$x_summary / count($points), $y_summary / count($points)];

        $distance = 0;
        foreach ($points as $point) {
            $point_distance = $this->distanceSquared($point, $average_coordinates);

            if ($point_distance > $distance) {
                $distance = $point_distance;
            }
        }

        $distance = sqrt($distance);

        return sprintf("%.5f %.5f %.5f", $average_coordinates[0], $average_coordinates[1], $distance);
    }


    /**
     * Calc distance between 2 points.
     * Note: distance squared
     *
     * @param array $start
     * @param array $end
     * @return float
     */
    private function distanceSquared($start, $end)
    {
        return pow($start[0] - $end[0], 2) + pow($start[1] - $end[1], 2);
    }
}