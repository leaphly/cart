<?php

namespace Leaphly\Cart\Repository;

use Leaphly\Cart\CartQuery;
use Leaphly\Cart\RepositoryInterface;
use Leaphly\Cart\Cart;

class ArrayRepository extends CartQuery implements RepositoryInterface
{
    public static $storage = array();

    /**
     * Finds a document by its identifier
     *
     * @param $identifier
     *
     * @return CartInterface
     */
    public function find($identifier)
    {
        return self::$storage[(string) $identifier];
    }

    /**
     * Finds one cart by the given criteria.
     *
     * @param array $criteria
     *
     * @return CartInterface
     * @throws \BadMethodCallException
     */
    public function findCartBy(array $criteria)
    {
        throw new \BadMethodCallException('findCartBy');
    }

    /**
     * Deletes a cart.
     *
     * @param mixed $identifier
     *
     * @return boolean
     */
    public function deleteCart($identifier)
    {
        unset(self::$storage[(string) $identifier]);

        return true;
    }

    /**
     * Updates a cart, if not exist the cart is created.
     *
     * @param Cart $cart
     * @param Boolean $andFlush
     *
     * @return boolean
     */
    public function updateCart(Cart $cart, $andFlush = true)
    {
        self::$storage[(string) $cart->getIdentifier()] = $cart;

        return true;
    }
}