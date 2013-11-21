<?php

namespace Leaphly\Cart\Event;

use Symfony\Component\EventDispatcher\Event;
use Leaphly\Cart\Model\CartInterface;

/**
 * The Cart Event
 *
 * @author Claudio D'Alicandro <claudio.dalicandro@gmail.com>
 */
class CartEvent extends Event
{
    /**
     * @var \Leaphly\Cart\Model\CartInterface
     */
    protected $cart;
    /**
     * @var array
     */
    protected $parameters;

    public function __construct(CartInterface $cart, array $parameters = null)
    {
        $this->cart = $cart;
        $this->parameters = $parameters;
    }

    /**
     * @return CartInterface
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }
}
