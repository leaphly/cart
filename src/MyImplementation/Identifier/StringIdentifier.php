<?php

namespace Leaphly\Cart\MyImplementation\Identifier;

use Leaphly\Cart\IdentifierInterface;

class StringIdentifier implements IdentifierInterface
{
    private $identifier;

    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    public function __toString()
    {
        return sprintf("#%d", $this->identifier);
    }
}
