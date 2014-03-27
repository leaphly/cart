<?php

namespace Leaphly\Cart;

interface ItemInterface extends EntityInterface
{
    /**
     * @return \Leaphly\Cart\ProductInterface
     */
    public function getProduct();

    /**
     * @return int
     */
    public function getQuantity();
}
