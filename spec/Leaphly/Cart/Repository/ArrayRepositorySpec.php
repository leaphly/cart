<?php

namespace spec\Leaphly\Cart\Repository;

use Leaphly\Cart\Cart;
use Leaphly\Cart\IdentityInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArrayRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Leaphly\Cart\Repository\ArrayRepository');
    }

    function it_should_find_a_cart_by_identity(Cart $cart, IdentityInterface $identity)
    {
        $identity->__toString()->willReturn("A");
        $cart->getIdentity()->willReturn($identity);
        $this->updateCart($cart);

        $this->find("A")->shouldBeLike($cart);
    }

    function it_should_delete_a_cart_by_identity_and_on_next_find_should_throw_exception(Cart $cart, IdentityInterface $identity)
    {
        $identity->__toString()->willReturn("A");
        $cart->getIdentity()->willReturn($identity);
        $this->updateCart($cart);
        $this->find("A")->shouldBeLike($cart);

        $this->deleteCart("A")->shouldBe(true);
        $this->shouldThrow('\Exception')->duringFind("A");
    }

    function it_should_create_a_cart_and_update_a_cart(Cart $cart, IdentityInterface $identity, Cart $cart2)
    {
        $identity->__toString()->willReturn("A");
        $cart->getIdentity()->willReturn($identity);
        $cart2->getIdentity()->willReturn($identity);

        $this->updateCart($cart); // insertion
        $this->find("A")->shouldBeLike($cart);
        $this->updateCart($cart2); // update
        $cartFound = $this->find("A");
        $cartFound->shouldBe($cart2);
        $cartFound->shouldNotBe($cart);
    }
} 