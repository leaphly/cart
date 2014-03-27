<?php

namespace spec\Leaphly\Cart\MyImplementation;

use Leaphly\Cart\IdentityInterface;
use Leaphly\Cart\MyImplementation\Bus\Ticket;
use Leaphly\Cart\MyImplementation\TShirt\Quantity;
use Leaphly\Cart\MyImplementation\TShirt\TShirt;
use Leaphly\Cart\MyImplementation\TShirt\TShirtItem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MyCartSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Leaphly\Cart\MyImplementation\MyCart');
    }

    function let(IdentityInterface $identity)
    {
        $this->beConstructedWith($identity);
    }

    function it_should_permit_to_add_bus_product_and_passengers(Ticket $ticket)
    {
        $this->addTicket($ticket)->shouldBeBoolean();
    }

    function it_should_permit_to_add_tshirt_product_size_and_quantity(TShirt $tShirt)
    {
        $this->addTShirt($tShirt, 3)->shouldBeBoolean();
    }

    function it_should_remove_an_item_by_product(IdentityInterface $identity, TShirt $tShirt, TShirtItem $TShirtItem)
    {
        $identity->__toString()->willReturn("A");
        $tShirt->getIdentity()->willReturn($identity);
        $TShirtItem->getIdentity()->willReturn("A");

        $this->addTShirt($tShirt, 3);
        $this->removeItem($TShirtItem)->shouldBeBoolean();
        $this->shouldThrow('\Exception')->duringRemoveItem($tShirt);
    }

    function it_modify_an_item_adding_the_quantity_for_a_tshirt(IdentityInterface $identity, TShirt $tShirt, TShirtItem $TShirtItem, TShirtItem $TShirtItemToAdd)
    {
        $identity->__toString()->willReturn("A");
        $tShirt->getIdentity()->willReturn($identity);
        $TShirtItem->getIdentity()->willReturn("A");
        $TShirtItemToAdd->getIdentity()->willReturn("A");
        $TShirtItem->addQuantity($TShirtItemToAdd)->shouldBeCalled();

        $this->addItem($TShirtItem);
        $this->addItem($TShirtItemToAdd);
    }

    function it_modify_an_item_reducing_the_quantity_for_a_tshirt(IdentityInterface $identity, TShirt $tShirt, TShirtItem $TShirtItem, TShirtItem $TShirtItemToAdd)
    {
        $identity->__toString()->willReturn("A");
        $tShirt->getIdentity()->willReturn($identity);
        $TShirtItem->getIdentity()->willReturn("A");
        $TShirtItemToAdd->getIdentity()->willReturn("A");
        $TShirtItem->subtractQuantity($TShirtItemToAdd)->shouldBeCalled();

        $this->addItem($TShirtItem);
        $this->subtractItem($TShirtItemToAdd);
    }

    function it_should_remove_an_item_from_the_cart()
    {

    }

    function it_should_get_an_item_by_item_or_identity()
    {

    }
}
