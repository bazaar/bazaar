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

use Bazaar\Component\Cart\Domain\Model\AbstractItem;
use Bazaar\Component\Cart\Domain\Model\ItemInterface;

/**
 * Basic Item Builder.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Item extends AbstractItem
{
    protected $identifier;
    protected $name;
    protected $description;
    protected $value;
    protected $options;
    protected $properties;

    /**
     * Constructor
     *
     * @param string $identifier  Identifier
     * @param int    $quantity    Quantity
     * @param string $name        Name
     * @param string $description Description
     * @param int    $value       Value
     * @param array  $options     Options
     * @param array  $properties  Properties
     */
    public function __construct($identifier, $quantity = 1, $name = null, $description = null, $value = null, array $options = array(), array $properties = array())
    {
        $this->identifier = $identifier;
        $this->setQuantity($quantity);
        $this->name = $name;
        $this->description = $description;
        $this->value = $value;
        $this->options = $options;
        $this->properties = $properties;
    }

    /**
     * Identifier
     *
     * @return string
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /**
     * Name
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Description
     *
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * Value
     *
     * @return int
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Name
     *
     * @return array
     */
    public function options()
    {
        return $this->options;
    }

    /**
     * Name
     *
     * @return array
     */
    public function properties()
    {
        return $this->properties;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(ItemInterface $item)
    {
        if (!$item instanceof Item) {
            return false;
        }

        return $item->identifier() === $this->identifier();
    }
}
