<?php

namespace Leaphly\Cart\MyImplementation\TShirt;

use Leaphly\Cart\IdentifierInterface;
use Leaphly\Cart\MyImplementation\Identifier\StringIdentifier;
use Leaphly\Cart\ProductInterface;

class TShirt implements ProductInterface
{
    /** @var Size */
    private $size;
    /** @var string  */
    private $sku;

    public function __construct($sku, Size $size)
    {
        $this->sku = $sku;
        $this->size = $size;
    }

    /**
     * @return IdentifierInterface
     */
    public function getIdentifier()
    {
        return new StringIdentifier(sprintf("%s-%s",$this->sku, $this->size));
    }
}
