<?php

namespace Leaphly\Cart\MyImplementation\Bus;

/**
 * Class Ride is the bus product
 * @package Leaphly\Cart\MyImplementation\Bus
 */
class Ride
{
    /** @var \Datetime */
    private $dateTime;
    /** @var string */
    private $format;

    private function __construct(\Datetime $dateTime, $format = 'Y-m-d H:i:s')
    {
        $this->dateTime = $dateTime;
        $this->format = $format;
    }

    public static function createFromFormat($format, $time,\DateTimeZone $timezone = null)
    {
        return new self(\Datetime::createFromFormat($format, $time, $timezone), $format);
    }

    public function createFromDatetime(\DateTime $dateTime, $format = null)
    {
        return new self($dateTime, $format);
    }

    public function __toString()
    {
        return $this->dateTime->format($this->format);
    }
}
