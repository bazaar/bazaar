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
 * Cart Interface.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface CartInterface
{
    /**
     * Identifier.
     *
     * @return string
     */
    public function identifier();

    /**
     * All Items.
     *
     * @return array
     */
    public function items();

    /**
     * Add Item to Cart.
     *
     * @param ItemInterface $item
     *
     * @return CartInterface
     */
    public function addItem(ItemInterface $item);

    /**
     * Updates Item in Cart.
     *
     * @param ItemInterface $item
     *
     * @return CartInterface
     */
    public function updateItem(ItemInterface $item);

    /**
     * Remove Item from Cart.
     *
     * @param ItemInterface $item
     *
     * @return CartInterface
     */
    public function removeItem(ItemInterface $item);

    /**
     * Clear all Items.
     *
     * @return CartInterface
     */
    public function clearItems();
}
