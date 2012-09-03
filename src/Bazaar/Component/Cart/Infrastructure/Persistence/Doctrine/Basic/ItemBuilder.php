<?php

/*
 * This file is a part of Bazaar.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bazaar\Component\Cart\Infrastructure\Persistence\Doctrine\Basic;

use Bazaar\Component\Cart\Domain\Model\Basic\ItemBuilder as BaseItemBuilder;
use Bazaar\Component\Cart\Domain\Model\CartInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Basic Item Builder.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ItemBuilder extends BaseItemBuilder
{
    protected $cart;

    /**
     * Constructor
     *
     * @param CartInterface $cart       Cart
     * @param string        $identifier Identifier
     * @param int           $quantity   Quantity
     *
     * @return ItemBuilder
     */
    public function __construct(CartInterface $cart, $identifier, $quantity = 1)
    {
        parent::__construct($identifier, $quantity);
        $this->cart = $cart;
    }

    /**
     * Build
     *
     * @return Basic
     */
    public function build()
    {
        $options = new ArrayCollection;
        $properties = new ArrayCollection;

        $basicItem = new Item(
            $this->cart,
            $this->identifier,
            $this->quantity,
            $this->name,
            $this->description,
            $this->value,
            $options,
            $properties
        );

        foreach ($this->options as $args) {
            $options->set($args[0], new ItemOption($basicItem, $args[0], $args[1], $args[2]));
        }

        foreach ($this->properties as $args) {
            $properties->set($args[0], new ItemProperty($basicItem, $args[0], $args[1], $args[2]));
        }

        return $basicItem;
    }
}
