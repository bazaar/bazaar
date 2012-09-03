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
 * Abstract Item.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
abstract class AbstractItem implements ItemInterface
{
    private $quantity;

    /**
     * {@inheritdoc}
     */
    public function quantity()
    {
        return $this->quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementQuantity($quantity)
    {
        $this->quantity += $quantity;

        return $this;
    }
}
