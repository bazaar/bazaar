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
 * Cart Storage Interface.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface CartStorageInterface
{
    /**
     * Get Cart Identifier for the current Cart.
     *
     * @return string
     */
    public function getCurrentCartIdentifier();

    /**
     * Set the current Cart.
     *
     * @param string $cartIdentifier
     */
    public function setCurrentCartIdentifier($cartIdentifier);

    /**
     * Abandon the current Cart.
     */
    public function abandonCurrentCart();
}
