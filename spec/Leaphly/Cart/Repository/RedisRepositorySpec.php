<?php

namespace spec\Leaphly\Cart\Repository;

use Leaphly\Cart\Cart;
use Leaphly\Cart\IdentityInterface;
use PhpSpec\ObjectBehavior;
use Predis\Client as BaseClient;
use Prophecy\Argument;

// waiting Phrophecy mocking magic calls
class Client extends BaseClient
{
    public function set($id, $obj)
    {}
    public function get($id)
    {}
    public function del($id)
    {}
}


class RedisRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Leaphly\Cart\Repository\RedisRepository');
    }

    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_should_call_client_del_during_deleteCart($client, IdentityInterface $identity)
    {
        $identity->__toString()->willReturn("A");

        $client->del(Argument::any())->shouldBeCalled();
        $this->deleteCart($identity);
    }

    function it_should_call_client_set_during_updateCart($client, Cart $cart, IdentityInterface $identity)
    {
        $identity->__toString()->willReturn("A");
        $cart->getIdentity()->willReturn($identity);

        $client->set($identity, $cart)->shouldBeCalled();
        $this->updateCart($cart);
    }

    function it_should_call_client_get_during_find($client, IdentityInterface $identity)
    {
        $identity->__toString()->willReturn("A");

        $client->get($identity)->shouldBeCalled();
        $this->find($identity);
    }
} 