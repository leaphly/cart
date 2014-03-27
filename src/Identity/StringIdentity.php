<?php

namespace Leaphly\Cart\Identity;

use Leaphly\Cart\IdentityInterface;

class StringIdentity implements IdentityInterface
{
    private $identity;

    public function __construct($identity)
    {
        $this->identity = $identity;
    }

    public function __toString()
    {
        return sprintf("#%d", $this->identity);
    }
}
