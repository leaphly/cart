<?php

namespace Leaphly\Cart;

/**
 *
 * @author Giulio De Donato <liuggio@gmail.com>
 */
interface QueryInterface
{
    /**
     * Finds a document by its identity
     *
     * @param $identity
     *
     * @return CartInterface
     */
    public function find($identity);

    /**
     * Finds one cart by the given criteria.
     *
     * @param array $criteria
     *
     * @return CartInterface
     */
    public function findCartBy(array $criteria);
}
