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
     * Finds a Cart by its identifier or raise the 404 exception.
     *
     * @param $identifier
     *
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function findOr404($identifier)
    {
        $cart = $this->find($identifier);
        if (!$cart) {
            throw new NotFoundHttpException($identifier);
        }

        return $cart;
    }
} 