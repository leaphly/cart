<?php

namespace Leaphly\Cart\Handler;

use Leaphly\Cart\Model\CartInterface;
use Leaphly\Cart\Model\ItemInterface;

/**
 *
 * @author Giulio De Donato <liuggio@gmail.com>
 *
 * @api
 */
Interface CartItemHandlerInterface extends ItemHandlerInterface
{
    /**
     * @param CartInterface $cart
     *
     * @return CartInterface
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     *
     * @api
     */
    public function deleteAllItems(CartInterface $cart);
}
