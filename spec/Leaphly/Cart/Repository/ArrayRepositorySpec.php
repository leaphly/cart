<?php

namespace spec\Leaphly\Cart\Repository;

use Leaphly\Cart\Cart;
use Leaphly\Cart\IdentifierInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArrayRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Leaphly\Cart\Repository\ArrayRepository');
    }

    function it_should_find_a_cart_by_identifier(Cart $cart, IdentifierInterface $identifier)
    {
        $identifier->__toString()->willReturn("A");
        $cart->getIdentifier()->willReturn($identifier);
        $this->updateCart($cart);

        $this->find("A")->shouldBeLike($cart);
    }

    function it_should_delete_a_cart_by_identifier_and_on_next_find_should_throw_exception(Cart $cart, IdentifierInterface $identifier)
    {
        $identifier->__toString()->willReturn("A");
        $cart->getIdentifier()->willReturn($identifier);
        $this->updateCart($cart);
        $this->find("A")->shouldBeLike($cart);

        $this->deleteCart("A")->shouldBe(true);
        $this->shouldThrow('\Exception')->duringFind("A");
    }

    function it_should_create_a_cart_and_update_a_cart(Cart $cart, IdentifierInterface $identifier, Cart $cart2)
    {
        $identifier->__toString()->willReturn("A");
        $cart->getIdentifier()->willReturn($identifier);
        $cart2->getIdentifier()->willReturn($identifier);

        $this->updateCart($cart); // insertion
        $this->find("A")->shouldBeLike($cart);
        $this->updateCart($cart2); // update
        $cartFound = $this->find("A");
        $cartFound->shouldBe($cart2);
        $cartFound->shouldNotBe($cart);
    }
} 