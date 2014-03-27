<?php

namespace spec\Leaphly\Cart\Repository;

use Leaphly\Cart\Cart;
use Leaphly\Cart\IdentifierInterface;
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

    function it_should_call_client_del_during_deleteCart($client, IdentifierInterface $identifier)
    {
        $identifier->__toString()->willReturn("A");

        $client->del(Argument::any())->shouldBeCalled();
        $this->deleteCart($identifier);
    }

    function it_should_call_client_set_during_updateCart($client, Cart $cart, IdentifierInterface $identifier)
    {
        $identifier->__toString()->willReturn("A");
        $cart->getIdentifier()->willReturn($identifier);

        $client->set($identifier, $cart)->shouldBeCalled();
        $this->updateCart($cart);
    }

    function it_should_call_client_get_during_find($client, IdentifierInterface $identifier)
    {
        $identifier->__toString()->willReturn("A");

        $client->get($identifier)->shouldBeCalled();
        $this->find($identifier);
    }
} 