<?php

namespace Leaphly\Cart\MyImplementation\Bus;

use Leaphly\Cart\ProductInterface;

class Ticket implements ProductInterface
{
    /** @var Ride */
    private $ride;
    /** @var Passenger  */
    private $passenger;

    public function __construct(Ride $ride, Passenger $passenger)
    {
        $this->ride = $ride;
        $this->passenger = $passenger;
    }

    /**
     * @return IdentifierInterface
     */
    public function getIdentifier()
    {
        return new StringIdentifier(sprintf("%s-%s", $this->ride, $this->passenger));
    }
}
