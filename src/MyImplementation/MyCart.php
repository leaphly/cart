<?php

namespace Leaphly\Cart\MyImplementation;

use Leaphly\Cart\Cart as BaseCart;
use Leaphly\Cart\Item;
use Leaphly\Cart\MyImplementation\Bus\Ticket;
use Leaphly\Cart\MyImplementation\TShirt\TShirt;
use Leaphly\Cart\MyImplementation\TShirt\TShirtItem;

class MyCart extends BaseCart
{
    /**
     *
     * @param Ticket $ticket
     *
     * @return string The Item Identity
     */
    public function addTicket(Ticket $ticket)
    {
        return $this->addItem(new Item($ticket));
    }

    /**
     * @param TShirt $tShirt
     * @param int    $quantity
     *
     * @return boolean
     */
    public function addTShirt(TShirt $tShirt, $quantity)
    {
        return $this->addItem(new TShirtItem($tShirt, $quantity));
    }
}
