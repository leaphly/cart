<?php

namespace Leaphly\Cart\Identity;

use Leaphly\Cart\IdentityInterface;

class RandomIdentity implements IdentityInterface
{
    private $identity;

    public function __construct()
    {
        $this->identity = rand(0, PHP_INT_MAX);
    }

    public function __toString()
    {
        return sprintf("#%d", $this->identity);
    }
}
