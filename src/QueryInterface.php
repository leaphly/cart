<?php

namespace Leaphly\Cart;

/**
 *
 * @author Giulio De Donato <liuggio@gmail.com>
 */
interface QueryInterface
{
    /**
     * Finds a document by its identifier
     *
     * @param $identifier
     *
     * @return CartInterface
     */
    public function find($identifier);

    /**
     * Finds one cart by the given criteria.
     *
     * @param array $criteria
     *
     * @return CartInterface
     */
    public function findCartBy(array $criteria);
}
