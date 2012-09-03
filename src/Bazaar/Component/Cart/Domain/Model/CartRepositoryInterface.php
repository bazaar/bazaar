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
 * Cart Repository Interface.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface CartRepositoryInterface
{
    /**
     * Find a Cart.
     *
     * @param string $cartIdentifier Cart Identifier
     *
     * @return CartInterface
     */
    public function find($cartIdentifier);

    /**
     * Store a Cart.
     *
     * @param CartInterface $cart
     */
    public function store(CartInterface $cart);

    /**
     * Remove a Cart.
     *
     * @param CartInterface $cart
     */
    public function remove(CartInterface $cart);
}
