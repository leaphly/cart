<?php

namespace Leaphly\Cart;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CartQuery
 * handle the reads operation to the persist layer.
 *
 */
abstract class CartQuery implements QueryInterface
{
    /**
     * Finds a Cart by its identity or raise the 404 exception.
     *
     * @param $identity
     *
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function findOr404($identity)
    {
        $cart = $this->find($identity);
        if (!$cart) {
            throw new NotFoundHttpException($identity);
        }

        return $cart;
    }
}
