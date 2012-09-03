<?php

/*
 * This file is a part of Bazaar.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bazaar\Component\Cart\Infrastructure\Persistence\Doctrine;

use Bazaar\Component\Cart\Domain\Model\Cart as BaseCart;
use Bazaar\Component\Cart\Domain\Model\ItemInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cart.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Cart extends BaseCart
{
    /**
     * {@inheritdoc}
     */
    public function __construct($identifier)
    {
        parent::__construct($identifier);
        $this->items = new ArrayCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function clearItems()
    {
        $this->items->clear();

        return $this;
    }
}
