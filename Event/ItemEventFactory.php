<?php

namespace Leaphly\Cart\Event;

use Leaphly\Cart\Event\ItemEvent;
use Leaphly\Cart\Model\CartInterface;
use Leaphly\Cart\Model\ItemInterface;

/**
 * Factory of ItemEvent
 *
 * @author Claudio D'Alicandro <claudio.dalicandro@gmail.com>
 */
class ItemEventFactory
{
    private $class;

    public function __construct($class = '\Leaphly\Cart\Event\ItemEvent')
    {
        $this->class = $class;
    }

    /**
     * @param CartInterface $cart
     * @param ItemInterface $item
     * @param array         $parameters
     *
     * @return \Symfony\Component\EventDispatcher\Event
     */
    public function getEvent(CartInterface $cart, ItemInterface $item, array $parameters = null)
    {
        $class = $this->class;

        return new $class($cart, $item, $parameters);
    }
}
