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
 * Cart Factory Interface.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface CartFactoryInterface
{
    /**
     * Create a cart.
     *
     * @return CartInterface
     */
    public function createCart();
}
