<?php

namespace Leaphly\Cart\Listener;

use Leaphly\Cart\Event\CartEvent;
use Leaphly\Cart\Calculator\PriceCalculatorInterface;

/**
 * Listener that calculate the price when Cart or Item are modified.
 *
 * @author Giulio De Donato <liuggio@gmail.com>
 */
class PriceCalculatorListener
{
    /**
     * @var string
     */
    private $class;
    /**
     * @var \Leaphly\Cart\Calculator\PriceCalculatorInterface
     */
    private $priceCalculator;

    /**
     * @param PriceCalculatorInterface $priceCalculator
     * @param string $class
     */
    public function __construct(PriceCalculatorInterface $priceCalculator, $class = 'Leaphly\Cart\Model\CartInterface')
    {
        $this->class = $class;
        $this->priceCalculator = $priceCalculator;
    }

    /**
     * Calculate the cart price.
     *
     * @param CartEvent $event
     */
    public function calculatePrice(CartEvent $event)
    {
        $this->priceCalculator->calculatePrice($event->getCart());
    }
}
