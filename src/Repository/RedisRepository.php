<?php

namespace Leaphly\Cart\Repository;

use Leaphly\Cart\CartQuery;
use Leaphly\Cart\RepositoryInterface;
use Leaphly\Cart\Cart;
use Predis\Client;

class RedisRepository extends CartQuery implements RepositoryInterface
{
    private $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client;
    }

    /**
     * Get a cart.
     *
     * @param string $identity
     *
     * @return \Leaphly\Cart\Cart
     */
    public function find($identity)
    {
        $this->client->get((string) $identity);
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
     * @param mixed $identity
     *
     * @return boolean
     */
    public function deleteCart($identity)
    {
        $this->client->del((string) $identity);
    }

    /**
     * Updates a cart, if not exist the cart is created.
     *
     * @param Cart    $cart
     * @param Boolean $andFlush
     *
     * @return boolean
     */
    public function updateCart(Cart $cart, $andFlush = true)
    {
        $this->client->set((string) $cart->getIdentity(), $cart);
    }
}
