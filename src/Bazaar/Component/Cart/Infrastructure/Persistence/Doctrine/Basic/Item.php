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

use Bazaar\Component\Cart\Domain\Model\Basic\Item as BaseItem;
use Bazaar\Component\Cart\Domain\Model\CartInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Basic Item.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Item extends BaseItem
{
    private $cart;
    protected $options;
    protected $properties;

    /**
     * Constructor
     *
     * @param CartInterface $cart        Cart
     * @param string        $identifier  Identifier
     * @param int           $quantity    Quantity
     * @param string        $name        Name
     * @param string        $description Description
     * @param int           $value       Value
     * @param Collection    $options     Options
     * @param Collection    $properties  Properties
     */
    public function __construct(CartInterface $cart, $identifier, $quantity = 1, $name = null, $description = null, $value = null, Collection $options = null, Collection $properties = null)
    {
        parent::__construct($identifier, $quantity, $name, $description, $value);
        $this->cart = $cart;
        $this->options = $options ?: new ArrayCollection;
        $this->properties = $properties ?: new ArrayCollection;
    }
}
