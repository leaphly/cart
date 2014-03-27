<?php

namespace Leaphly\Cart\Price;

use Leaphly\Cart\Cart;
use Leaphly\Cart\ItemInterface;

interface PriceServiceInterface
{
    /**
     * @param Cart $cart
     * @param $context
     *
     * @return PriceSet
     */
    public function calculatePriceSetForCart(Cart $cart, $context);

    /**
     * @param ItemInterface $item
     * @param array         $context
     *
     * @return Priceset
     */
    public function calculatePriceSetForItem(ItemInterface $item, $context);
}
