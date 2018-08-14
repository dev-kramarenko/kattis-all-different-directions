<?php
/**
 * Created by PhpStorm.
 * User: Aleksandr Kramarenko
 * Date: 14-Aug-18
 * Time: 11:15
 */

namespace App;


use function Couchbase\defaultDecoder;

/**
 * Class Parser
 * @package App
 */
class Parser
{
    private $degree = 0;
    private $x = 0;
    private $y = 0;


    /**
     * Parser constructor.
     * Parse directions string on init and do actions: start, walk and turn
     *
     * @param $str
     */
    public function __construct($str = '')
    {
        if (empty($str)) {
            throw new \InvalidArgumentException('Direction cannot be empty');
        }

        $args = explode(' ', $str);
        if (count($args) < 4) {
            throw new \InvalidArgumentException("Direction must contain a minimum 4 arguments");
        }

        // set start coordinates
        $this->x = (float)array_shift($args);
        $this->y = (float)array_shift($args);

        while (!empty($args)) {
            $action = trim(array_shift($args));

            $value = array_shift($args);
            if (is_null($value)) {
                throw new \InvalidArgumentException("Value for action '$action' is not defined");
            }
            $value = (float)$value;

            switch ($action) {
                case 'start':
                    $this->start($value);
                    break;
                case 'walk':
                    $this->walk($value);
                    break;
                case 'turn':
                    $this->turn($value);
                    break;
                default:
                    throw new \InvalidArgumentException("Action '$action' is not supported");
            }
        }
    }


    /**
     * Set start degree
     * @param $degree
     */
    private function start($degree)
    {
        $this->degree = $degree;
    }


    /**
     * Change degree
     * @param $degree
     */
    private function turn($degree)
    {
        $this->degree += $degree;
    }


    /**
     * Calculate new position by current degree and distance
     *
     * @param $distance
     */
    private function walk($distance)
    {
        $this->x += $distance * cos(deg2rad($this->degree));
        $this->y += $distance * sin(deg2rad($this->degree));
    }


    /**
     * Get latest coordinates
     * @return array
     */
    public function getPoint()
    {
        return [$this->x, $this->y];
    }
}