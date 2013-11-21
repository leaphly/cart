<?php

namespace Leaphly\Cart\Calculator;

use Leaphly\Cart\Model\CartInterface;

/**
 * This Calculate the prices given a cart.
 *
 * @author Giulio De Donato <liuggio@gmail.com>
 */
Interface PriceCalculatorInterface
{
    /**
     * Calculates and updates Cart prices.
     *
     * @param CartInterface $cart
     */
    public function calculatePrice(CartInterface $cart);
}
