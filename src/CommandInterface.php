<?php

namespace Leaphly\Cart;

/**
 * @author Giulio De Donato <liuggio@gmail.com>
 */
interface CommandInterface
{
    /**
     * Deletes a cart.
     *
     * @param mixed $identifier
     *
     * @return boolean
     */
    public function deleteCart($identifier);

    /**
     * Updates a cart, if not exist the cart is created.
     *
     * @param Cart $cart
     * @param Boolean       $andFlush
     *
     * @return boolean
     */
    public function updateCart(Cart $cart, $andFlush = true);
} 