<?php

namespace Leaphly\Cart\MyImplementation\TShirt;

class Size
{
    private $size;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function __toString()
    {
        return (string) $this->size;
    }
}
