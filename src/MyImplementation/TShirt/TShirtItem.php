<?php

namespace Leaphly\Cart\MyImplementation\TShirt;

use Leaphly\Cart\ItemInterface;
use Leaphly\Cart\Item;

class TShirtItem extends Item implements ItemInterface
{

    public function __construct(TShirt $TShirt, $quantity = 1)
    {
        parent::__construct($TShirt, $quantity);
        // do some extra stuff very TShirt Domain related
    }
}
