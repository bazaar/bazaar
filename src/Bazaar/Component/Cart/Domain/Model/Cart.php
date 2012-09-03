<?php

/*
 * This file is a part of Bazaar.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bazaar\Component\Cart\Domain\Model;

/**
 * Cart.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Cart implements CartInterface
{
    protected $identifier;
    protected $items;

    /**
     * Constructor
     *
     * @param string $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
        $this->items = array();
    }

    /**
     * {@inheritdoc}
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /**
     * All Items.
     *
     * @return array
     */
    public function items()
    {
        return array_values($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(ItemInterface $item)
    {
        $exists = false;
        foreach ($this->items as $existingItem) {
            if ($item->equals($existingItem)) {
                $existingItem->incrementQuantity($item->quantity());
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            $this->items[] = $item;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function updateItem(ItemInterface $item)
    {
        $exists = false;
        foreach ($this->items as $existingItem) {
            if ($item->equals($existingItem)) {
                $this->removeItem($existingItem);
                $this->items[] = $item;

                return $this;
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(ItemInterface $item)
    {
        $key = $this->searchItem($item);

        if (false !== $key) {
            unset($this->items[$key]);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clearItems()
    {
        $this->items = array();

        return $this;
    }

    /**
     * Search for Item
     *
     * @param ItemInterface $item
     *
     * @return mixed
     */
    protected function searchItem(ItemInterface $item)
    {
        return array_search($item, $this->items, true);
    }
}
