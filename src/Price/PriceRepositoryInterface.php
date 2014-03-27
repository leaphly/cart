<?php

namespace Leaphly\Cart\Price;

interface PriceRepositoryInterface
{
    /**
     * @param  mixed $productIdentity
     * @param  mixed $context
     * @return mixed
     *
     * @return Price
     */
    public function getPriceForProductIdentity($productIdentity, $context);
}
