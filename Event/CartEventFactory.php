<?php

namespace Leaphly\Cart\Event;

use Leaphly\Cart\Model\CartInterface;

/**
 * Event Factory
 *
 * @author Claudio D'Alicandro <claudio.dalicandro@gmail.com>
 */
class CartEventFactory
{
    private $class;

    public function __construct($class = '\Leaphly\Cart\Event\CartEvent')
    {
        $this->class = $class;
    }

    /**
     * @param CartInterface $cart
     * @param array         $parameters
     *
     * @return \Symfony\Component\EventDispatcher\Event
     */
    public function getEvent(CartInterface $cart, array $parameters = null)
    {
        $class = $this->class;

        return new $class($cart, $parameters);
    }
}
