<?php

/*
 * This file is a part of Bazaar.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bazaar\Component\Cart\Domain\Model\Basic;

/**
 * Basic Item Builder Factory.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ItemBuilderFactory
{
    /**
     * Create
     *
     * @param string $identifier Identifier
     * @param int    $quantity   Quantity
     *
     * @return BasicitemBuilder
     */
    public function create($identifier, $quantity = 1)
    {
        return new ItemBuilder($identifier, $quantity);
    }
}
