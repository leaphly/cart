<?php

namespace Leaphly\Cart\MyImplementation\TShirt;

use Leaphly\Cart\IdentityInterface;
use Leaphly\Cart\Identity\StringIdentity;
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
     * @return IdentityInterface
     */
    public function getIdentity()
    {
        return new StringIdentity(sprintf("%s-%s",$this->sku, $this->size));
    }
}
