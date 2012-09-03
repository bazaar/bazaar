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
 * Cart Provider Interface.
 *
 * Provides the active Cart instance.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface CartProviderInterface
{
    /**
     * Gets the active Cart
     *
     * If no cart is active a new cart will be created.
     *
     * @return CartInterface
     */
    public function getCart();

    /**
     * Sets the active Cart
     *
     * @param CartInterface $cart
     */
    public function setCart(CartInterface $cart);

    /**
     * Abandon the active Cart
     */
    public function abandonCart();
}
