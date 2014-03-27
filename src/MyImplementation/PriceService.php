<?php

namespace Leaphly\Cart\MyImplementation;

use Leaphly\Cart\Cart;
use Leaphly\Cart\ItemInterface;
use Leaphly\Cart\Price\Price;
use Leaphly\Cart\Price\PriceServiceInterface;
use Leaphly\Cart\Price\PriceRepositoryInterface;

/**
 * Class PriceService
 * This is an implementation for the PriceServiceInterface.
 *
 * It retrieve and calculate a PriceSet for a Cart, an Item, and a Product.
 * The PriceSet for a Cart is the sum of the price of the PriceSet Items.
 * A price of the Item is The Price of the product given a $context.
 *
 * @package Leaphly\Cart\MyImplementation
 */
class PriceService implements PriceServiceInterface
{
    /**
     * @var PriceRepositoryInterface
     */
    private $priceRepository;

    function __construct(PriceRepositoryInterface $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    /**
     * @param Cart $cart
     * @param $context
     *
     * @return PriceSet
     */
    public function calculatePriceSetForCart(Cart $cart, $context)
    {
        $price = null;
        foreach ($cart->getItems() as $item) {
            if (null === $price) {
                $price = $this->calculatePriceSetForItem($item, $context);
                continue;
            }

            $price = $price->add($this->calculatePriceSetForItem($item, $context));
        }

        return $price;
    }

    /**
     * @param ItemInterface $item
     * @param array $context
     *
     * @return PriceSet
     */
    public function calculatePriceSetForItem(ItemInterface $item, $context)
    {
       $price = $this->calculatePriceSetForProduct($item->getProduct(), $context);
       $price->multiply($item->getQuantity());

       return $price;
    }

    /**
     * @param ProductInterface $product
     * @param array $context
     *
     * @return PriceSet
     */
    public function calculatePriceSetForProduct(ProductInterface $product, $context)
    {
        return $this->priceRepository->getPriceSetForProductIdentity($product->getIdentity(), $context);
    }
} 