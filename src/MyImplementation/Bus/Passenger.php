<?php

namespace Leaphly\Cart\MyImplementation\Bus;

/**
 * Class Passenger is the number of the persons that are going to u
 * @package Leaphly\Cart\MyImplementation\Bus
 */
class Passenger
{
    private $adult;
    private $children;

    public function __construct($adult = 1, $children = 0)
    {
        $this->adult = $adult;
        $this->children = $children;
    }

    /**
     * @return int
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @return int
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function __toString()
    {
        return sprintf("%s,%s", $this->adult, $this->children);
    }
}
