<?php

namespace Leaphly\Cart\MyImplementation\Bus;

use Leaphly\Cart\ProductInterface;
use Leaphly\Cart\Identity\StringIdentity;

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
     * @return IdentityInterface
     */
    public function getIdentity()
    {
        return new StringIdentity(sprintf("%s-%s", $this->ride, $this->passenger));
    }
}
