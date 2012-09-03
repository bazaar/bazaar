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
 * Item Interface.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface ItemInterface
{
    /**
     * Quantity
     *
     * @return int
     */
    public function quantity();

    /**
     * Set quantity
     *
     * @param int $quantity
     *
     * @return ItemInterface
     */
    public function setQuantity($quantity);

    /**
     * Increment quantity
     *
     * @param int $quantity
     *
     * @return ItemInterface
     */
    public function incrementQuantity($quantity);

    /**
     * Is the specified Item the same item?
     *
     * @param ItemInterface $item
     *
     * @return bool
     */
    public function equals(ItemInterface $item);
}
