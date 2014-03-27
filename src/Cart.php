<?php

namespace Leaphly\Cart;

use Doctrine\Common\Collections\ArrayCollection;

class Cart
{
    /** @var \Leaphly\Cart\IdentityInterface */
    protected $identity;
    /** @var  \Doctrine\Common\Collections\ArrayCollection */
    protected $items;

    public function __construct(IdentityInterface $identity)
    {
        $this->identity = $identity;
        $this->items = new ArrayCollection();
    }

    /**
     * Add an Item to the Cart, if the identity already exists, it increases the quantity
     *
     * @param ItemInterface $item

     * @return boolean
     */
    public function addItem(ItemInterface $item)
    {
        if ($this->items->containsKey($item->getIdentity())) {
            $this->items->get($item->getIdentity())->addQuantity($item);

            return true;
        }
        $this->items->set($item->getIdentity(), $item);

        return true;
    }

    /**
     * Subtract an Item from the Cart, if the identity does not exists an Exception is raised.
     *
     * @param ItemInterface $item

     * @return boolean
     * @throws \Exception
     */
    public function subtractItem(ItemInterface $item)
    {
        if ($this->items->containsKey($item->getIdentity())) {

            $this->items->get($item->getIdentity())->subtractQuantity($item);

            return true;
        }

        /* @todo: exception */
        throw new \Exception('impossible to find Item');
    }

    /**
     * Subtract an Item from the Cart, if the identity does not exists an Exception is raised.
     *
     * @param IdentityInterface|ItemInterface $identityOrItem
     *
     * @return boolean
     * @throws \Exception
     */
    public function removeItem($identityOrItem)
    {
        $identity = $identityOrItem;
        if ($identityOrItem instanceof ItemInterface) {
            $identity = $identityOrItem->getIdentity();
        }

        if (null == $this->items->remove($identity)) {

            /* @todo: exception */
            throw new \Exception('impossible to find Item');
        }

        return true;
    }

    /**
     *
     * @param IdentityInterface|ItemInterface $identityOrItem
     *
     * @return mixed|null
     */
    public function getItem($identityOrItem)
    {
        $identity = $identityOrItem;
        if ($identityOrItem instanceof ItemInterface) {
            $identity = $identityOrItem->getIdentity();
        }

        return $this->items->get($identity);
    }

    /**
     * @return \Leaphly\Cart\IdentityInterface
     */
    public function getIdentity()
    {
        return $this->identity;
    }
}
