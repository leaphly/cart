<?php

namespace Leaphly\Cart;

use Doctrine\Common\Collections\ArrayCollection;

class Cart
{
    /** @var \Leaphly\Cart\IdentifierInterface */
    protected $identifier;
    /** @var \Leaphly\Cart\RepositoryInterface */
    protected $repository;
    /** @var  \Doctrine\Common\Collections\ArrayCollection */
    protected $items;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->items = new ArrayCollection();
    }

    /**
     * Add an Item to the Cart, if the identifier already exists, it increases the quantity
     *
     * @param ItemInterface $item

     * @return boolean
     */
    public function addItem(ItemInterface $item)
    {
        if ($this->items->containsKey($item->getIdentifier())) {
            $this->items->get($item->getIdentifier())->addQuantity($item);

            return true;
        }
        $this->items->set($item->getIdentifier(), $item);

        return true;
    }

    /**
     * Subtract an Item from the Cart, if the identifier does not exists an Exception is raised.
     *
     * @param ItemInterface $item

     * @return boolean
     * @throws \Exception
     */
    public function subtractItem(ItemInterface $item)
    {
        if ($this->items->containsKey($item->getIdentifier())) {

            $this->items->get($item->getIdentifier())->subtractQuantity($item);

            return true;
        }

        /* @todo: exception */
        throw new \Exception('impossible to find Item');
    }

    /**
     * Subtract an Item from the Cart, if the identifier does not exists an Exception is raised.
     *
     * @param IdentifierInterface|ItemInterface $identifierOrItem
     *
     * @return boolean
     * @throws \Exception
     */
    public function removeItem($identifierOrItem)
    {
        $identifier = $identifierOrItem;
        if ($identifierOrItem instanceof ItemInterface) {
            $identifier = $identifierOrItem->getIdentifier();
        }

        if (null == $this->items->remove($identifier)) {

            /* @todo: exception */
            throw new \Exception('impossible to find Item');
        }

        return true;
    }

    /**
     *
     * @param IdentifierInterface|ItemInterface $identifierOrItem
     *
     * @return mixed|null
     */
    public function getItem($identifierOrItem)
    {
        $identifier = $identifierOrItem;
        if ($identifierOrItem instanceof ItemInterface) {
            $identifier = $identifierOrItem->getIdentifier();
        }

        return $this->items->get($identifier);
    }

    /**
     * @return \Leaphly\Cart\IdentifierInterface
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
}
