<?php

namespace Leaphly\Cart;

class Item implements ItemInterface
{
    /** @var \Leaphly\Cart\ProductInterface */
    private $product;
    /** @var int */
    private $quantity;

    public function __construct(ProductInterface $product, $quantity = 1)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return \Leaphly\Cart\ProductInterface
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param int|Item $offsetOrItem
     */
    public function addQuantity($offsetOrItem)
    {
        if (!is_numeric($offsetOrItem)) {
            $offsetOrItem = $offsetOrItem->getQuantity();
        }
        $this->quantity += $offsetOrItem;
    }

    /**
     * @param int|Item $offsetOrItem
     */
    public function subtractQuantity($offsetOrItem)
    {
        if (!is_numeric($offsetOrItem)) {
            $offsetOrItem = $offsetOrItem->getQuantity();
        }
        $this->quantity -= $offsetOrItem;
    }

    public function isQuantityZero()
    {
        return (0 >= $this->quantity);
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Is not might change on different TypeItem.
     *
     * @return \Leaphly\Cart\IdentifierInterface
     */
    public function getIdentifier()
    {
        return (string) $this->getProduct()->getIdentifier();
    }
}
