<?php

namespace Leaphly\Cart\Event;

use Symfony\Component\EventDispatcher\Event;
use Leaphly\Cart\Model\ItemInterface;
use Leaphly\Cart\Model\CartInterface;

/**
 * Item Event Class
 *
 * @author Claudio D'Alicandro <claudio.dalicandro@gmail.com>
 */
class ItemEvent extends CartEvent
{
    /**
     * @var \Leaphly\Cart\Model\ItemInterface
     */
    protected $item;

    /**
     * @param CartInterface $cart
     * @param ItemInterface $item
     * @param array         $parameters
     */
    public function __construct(CartInterface $cart, ItemInterface $item, array $parameters = null)
    {
        $this->cart       = $cart;
        $this->item       = $item;
        $this->parameters = $parameters;
    }

    /**
     * @return ItemInterface
     */
    public function getItem()
    {
        return $this->item;
    }
}
