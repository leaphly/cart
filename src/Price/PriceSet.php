<?php

namespace Leaphly\Cart\Price;

use Money\Money;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class PriceSet
 * Price is a money that depends on the context.
 *
 * Array of context => Money
 * 'Total' => Money(3, EUR)
 * 'BeforeDiscount' => Money(4, EUR)
 *
 * or
 * 'Stay Here' => Money(3, EUR)
 * 'Take Away' => Money(4, EUR)
 *
 * The Math operation eg. add, subtract, multiply, divide works only if two objects have the same contexts.
 *
 * @package Leaphly\Cart\Price
 */
Class PriceSet
{
    const TOTAL = 'total';

    private $defaultContext = self::TOTAL;
    /** @var \Doctrine\Common\Collections\ArrayCollection */
    private $prices;

    /**
     * @param Money|Array $prices
     * @param null        $defaultKey
     */
    public function __construct($prices, $defaultKey = null)
    {
        if ($prices instanceof Money) {
            $prices = array(self::TOTAL => $prices);
            $defaultKey = self::TOTAL;
        }

        $this->prices = new ArrayCollection($prices);

        if (null == $defaultKey && $this->prices->count()>0) {
            $this->prices->first();
            $defaultKey = $this->prices->key();
        }

        if ($this->prices->count()>0 && !$this->prices->containsKey($defaultKey)) {
            throw new \Exception('Impossible to find defaultkey as '.$defaultKey);
        }

        $this->defaultContext = $defaultKey;
    }

    /**
     * @return Money|null
     */
    public function getDefaultPrice()
    {
        return $this->prices->get($this->defaultContext);
    }

    /**
     * @return ArrayCollection
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param  PriceSet $other
     * @return bool
     */
    public function equals(PriceSet $other)
    {
         //@TODO
    }

    /**
     * @param PriceSet $addend
     *
     * @return PriceSet
     */
    public function add(PriceSet $addend)
    {
        $newPrices = $this->getPrices();
        $addendPrices = $addend->getPrices();

        foreach ($addendPrices as $k => $money) {
            if ($newPrices->containsKey($k)) {
                $money = $money->add($newPrices->get($k));
            }
            $newPrices->set($k, $money);
        }

        return new PriceSet($newPrices->toArray(), $this->defaultContext);
    }

    /**
     * @param  PriceSet $subtrahend
     * @return PriceSet
     */
    public function subtract(PriceSet $subtrahend)
    {
        $newPrices = $this->getPrices();
        $addendPrices = $subtrahend->getPrices();

        foreach ($addendPrices as $k => $money) {
            if ($newPrices->containsKey($k)) {
                $money = $money->subtract($newPrices->get($k));
            }
            $newPrices->set($k, $money);
        }

        return new PriceSet($newPrices->toArray(), $this->defaultContext);
    }

    /**
     * @param $multiplier
     * @param  int      $rounding_mode
     * @return PriceSet
     */
    public function multiply($multiplier, $rounding_mode = Money::ROUND_HALF_UP)
    {
        $newPrices = new ArrayCollection();

        foreach ($this->getPrices() as $k => $money) {
            $newPrices->set($k, $money->multiply($multiplier, $rounding_mode));
        }

        return new PriceSet($newPrices->toArray(), $this->defaultContext);
    }

    /**
     * @param $divisor
     * @param  int      $rounding_mode
     * @return PriceSet
     */
    public function divide($divisor, $rounding_mode = Money::ROUND_HALF_UP)
    {
        $newPrices = new ArrayCollection();

        foreach ($this->getPrices() as $k => $money) {
            $newPrices->set($k, $money->divide($divisor, $rounding_mode));
        }

        return new PriceSet($newPrices->toArray(), $this->defaultContext);
    }
}
