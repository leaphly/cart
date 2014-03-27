<?php

namespace spec\Leaphly\Cart\Price;

use Leaphly\Cart\Price\PriceSet;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PriceSetSpec extends ObjectBehavior
{
    function it_is_initializable_with_empty_array()
    {
        $this->beConstructedWith(array());
        $this->shouldHaveType('Leaphly\Cart\Price\PriceSet');
    }

    function it_is_initializable_with_a_money(Money $money)
    {
        $this->beConstructedWith($money);
        $this->getDefaultPrice()->shouldBe($money);
        $this->getPrices()->shouldHaveCount(1);
    }

    function it_is_initializable_with_an_associative_array_of_money()
    {
        $assertDefault = Money::EUR(10);

        $set = array(
            'Stay Here' => $assertDefault,
            'Take away' => Money::EUR(30)
        );

        $this->beConstructedWith($set);
        $this->getDefaultPrice()->shouldBe($assertDefault);
    }

    function it_should_add_another_PriceSet_with_same_contexts()
    {
        $set = array(
            'Stay Here' => Money::EUR(10),
            'Take away' => Money::EUR(30)
        );
        $this->beConstructedWith($set);

        $priceSet = new PriceSet($set);

        $prices = $this->add($priceSet)->getPrices();

        $prices->get('Stay Here')->equals(Money::EUR(20))->shouldBe(true);
        $prices->get('Take away')->equals(Money::EUR(60))->shouldBe(true);
    }

    function it_should_add_another_PriceSet_with_differnt_contexts()
    {
        $set1 = array(
            'Stay Here' => Money::EUR(10),
            'Upstairs' => Money::EUR(90)
        );
        $set2 = array(
            'Stay Here' => Money::EUR(10),
            'Take away' => Money::EUR(30)
        );
        $this->beConstructedWith($set1);

        $priceSet = new PriceSet($set2);

        $prices = $this->add($priceSet)->getPrices();

        $prices->get('Stay Here')->equals(Money::EUR(20))->shouldBe(true);
        $prices->get('Take away')->equals(Money::EUR(30))->shouldBe(true);
        $prices->get('Upstairs')->equals(Money::EUR(90))->shouldBe(true);
    }

    function it_should_subtract_another_PriceSet_with_same_contexts()
    {
        $set = array(
            'Stay Here' => Money::EUR(10),
            'Take away' => Money::EUR(30)
        );
        $this->beConstructedWith($set);

        $priceSet = new PriceSet($set);

        $prices = $this->subtract($priceSet)->getPrices();

        $prices->get('Stay Here')->equals(Money::EUR(0))->shouldBe(true);
        $prices->get('Take away')->equals(Money::EUR(0))->shouldBe(true);
    }

    function it_should_subtract_another_PriceSet_with_differnt_contexts()
    {
        $set1 = array(
            'Stay Here' => Money::EUR(5),
            'Upstairs' => Money::EUR(90)
        );
        $set2 = array(
            'Stay Here' => Money::EUR(10),
            'Take away' => Money::EUR(30)
        );
        $this->beConstructedWith($set1);

        $priceSet = new PriceSet($set2);

        $prices = $this->subtract($priceSet)->getPrices();

        $prices->get('Stay Here')->equals(Money::EUR(5))->shouldBe(true);
        $prices->get('Take away')->equals(Money::EUR(30))->shouldBe(true);
        $prices->get('Upstairs')->equals(Money::EUR(90))->shouldBe(true);
    }


    function it_should_multiply_foreach_contexts()
    {
        $set1 = array(
            'Stay Here' => Money::EUR(10),
            'Take away' => Money::EUR(45)
        );

        $this->beConstructedWith($set1);

        $prices = $this->multiply(2)->getPrices();

        $prices->get('Stay Here')->equals(Money::EUR(20))->shouldBe(true);
        $prices->get('Take away')->equals(Money::EUR(90))->shouldBe(true);
    }

    function it_should_divide_foreach_contexts()
    {
        $set1 = array(
            'Stay Here' => Money::EUR(10),
            'Take away' => Money::EUR(90)
        );

        $this->beConstructedWith($set1);

        $prices = $this->divide(2)->getPrices();

        $prices->get('Stay Here')->equals(Money::EUR(5))->shouldBe(true);
        $prices->get('Take away')->equals(Money::EUR(45))->shouldBe(true);
    }

} 