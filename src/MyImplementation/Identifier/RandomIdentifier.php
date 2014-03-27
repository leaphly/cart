<?php

namespace Leaphly\Cart\MyImplementation\Identifier;

use Leaphly\Cart\IdentifierInterface;

class RandomIdentifier implements IdentifierInterface
{
    private $identifier;

    public function __construct()
    {
        $this->identifier = rand(0, PHP_INT_MAX);
    }

    public function __toString()
    {
        return sprintf("#%d", $this->identifier);
    }
}
