<?php

namespace Leaphly\Cart\Tests\Handler;

use Leaphly\Cart\Event\CartEventFactory;
use Leaphly\Cart\LeaphlyCartEvents;
use Leaphly\Cart\Handler\CartHandler;
use Leaphly\Cart\Tests\TestCart;

/**
 *
 * @author Giulio De Donato <liuggio@gmail.com>
 * @package Leaphly\Cart\Tests\Handler
 */
class CartHandlerTest extends \PHPUnit_Framework_TestCase
{
    private $cartManagerMock;
    private $factory;
    private $transitionMock;
    private $eventFactory;
    private $dispatcher;

    public function setUp()
    {
        $this->transitionMock = $this->getMockBuilder('Leaphly\Cart\Transition\TransitionInterface')
            ->disableOriginalConstructor()->getMock();
        $this->cartManagerMock = $this->getMock('Leaphly\Cart\Model\CartManagerInterface');
        $this->factory = $this->getMock('Leaphly\Cart\Form\Factory\FactoryInterface');
        $this->eventFactory = new CartEventFactory();
        $this->dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
    }

    public function testDeleteCart()
    {
        $cartIdentifier = 100;
        $cart = new TestCart();
        $cart->setId($cartIdentifier);

        $this->cartManagerMock->expects($this->once())
            ->method('deleteCart')
            ->with($this->equalTo($cart));

        $handler = new CartHandler(
            $this->cartManagerMock,
            $this->factory,
            $this->transitionMock,
            $this->dispatcher,
            $this->eventFactory,
            array());

        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_DELETE_COMPLETED), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));

        $handler->deleteCart($cart);
    }


    public function testPostCart()
    {
        $priceToAssert = 10;
        $cartIdentifier = 100;
        $cart = new TestCart();
        $cart->setId($cartIdentifier);

        $this->cartManagerMock->expects($this->once())
            ->method('createCart')
            ->will($this->returnValue($cart));

        $cart = new TestCart();
        $cart->setPrice($priceToAssert);

        $this->cartManagerMock->expects($this->once())
            ->method('updateCart')
            ->with($this->equalTo($cart));

        $form = $this->getMock('Leaphly\Cart\Tests\FormInterface');
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($cart));

        $this->factory->expects($this->once())
            ->method('createForm')
            ->will($this->returnValue($form));

        $handler = new CartHandler(
            $this->cartManagerMock,
            $this->factory,
            $this->transitionMock,
            $this->dispatcher,
            $this->eventFactory,
            array());
        $parameters = array('family' => '');

        $this->dispatcher->expects($this->at(0))
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_CREATE_INITIALIZE), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));
        $this->dispatcher->expects($this->at(1))
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_CREATE_SUCCESS), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));
        $this->dispatcher->expects($this->at(2))
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_CREATE_COMPLETED), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));
        $this->dispatcher->expects($this->exactly(3))
            ->method('dispatch');

        $cartAssert = $handler->postCart($parameters);

        $this->assertEquals($cartAssert->getPrice(), $priceToAssert);

    }

    public function testPutCart()
    {
        $priceToAssert = 10;
        $cartIdentifier = 100;
        $cart = new TestCart();

        $cart->setId($cartIdentifier);
        $cart->setPrice($priceToAssert);

        $this->cartManagerMock->expects($this->once())
            ->method('updateCart')
            ->with($this->equalTo($cart));

        $form = $this->getMock('Leaphly\Cart\Tests\FormInterface');
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($cart));

        $this->factory->expects($this->once())
            ->method('createForm')
            ->will($this->returnValue($form));

        $handler = new CartHandler(
            $this->cartManagerMock,
            $this->factory,
            $this->transitionMock,
            $this->dispatcher,
            $this->eventFactory,
            array());

        $parameters = array('family' => '');

        $this->dispatcher->expects($this->at(0))
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_EDIT_INITIALIZE), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));
        $this->dispatcher->expects($this->at(1))
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_EDIT_SUCCESS), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));
        $this->dispatcher->expects($this->at(2))
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_EDIT_COMPLETED), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));
        $this->dispatcher->expects($this->exactly(3))
            ->method('dispatch');

        $cartAssert = $handler->putCart($cart, $parameters);

        $this->assertEquals($cartAssert->getPrice(), $priceToAssert);

    }

    /**
     * @dataProvider getPatchParameters
     */
    public function testPatchCart($parameters, $isGood)
    {
        $startingPrice=100.00;

        $form = $this->getMock('Leaphly\Cart\Tests\FormInterface');
        $form->expects($this->once())
            ->method('submit')
            ->with($this->equalTo($parameters));

        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));

        $cart = new TestCart();
        $cart->setPrice($startingPrice);

        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($cart));

        $this->factory->expects($this->once())
            ->method('createForm')
            ->will($this->returnValue($form));

        $this->cartManagerMock->expects($this->once())
                ->method('updateCart')
                ->with($this->equalTo($cart));

        $handler = new CartHandler(
            $this->cartManagerMock,
            $this->factory,
            $this->transitionMock,
            $this->dispatcher,
            $this->eventFactory,
            array('price'));

        $this->dispatcher->expects($this->at(0))
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_EDIT_INITIALIZE), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));
        $this->dispatcher->expects($this->at(1))
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_EDIT_SUCCESS), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));
        $this->dispatcher->expects($this->at(2))
            ->method('dispatch')
            ->with($this->equalTo(LeaphlyCartEvents::CART_EDIT_COMPLETED), $this->isInstanceOf('\Leaphly\Cart\Event\CartEvent'));
        $this->dispatcher->expects($this->exactly(3))
            ->method('dispatch');

        $cartAssert = $handler->patchCart($cart, $parameters);

        $this->assertInstanceOf('\Leaphly\Cart\Model\CartInterface', $cartAssert);

    }

    public function getPatchParameters()
    {
        return array(
            array(
                array('price' => 300.05),
                true
            ),
            array(
                array(
                    'price' => 300.05,
                    'ignored' => 'blah'
                ),
                true
            )
        );
    }
}
