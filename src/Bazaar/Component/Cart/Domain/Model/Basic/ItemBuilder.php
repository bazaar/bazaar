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
 * Basic Item Builder.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ItemBuilder
{
    protected $identifier;
    protected $quantity;
    protected $name;
    protected $description;
    protected $value;
    protected $options;
    protected $properties;

    /**
     * Constructor
     *
     * @param string $identifier Identifier
     * @param int    $quantity   Quantity
     *
     * @return ItemBuilder
     */
    public function __construct($identifier, $quantity = 1)
    {
        $this->identifier = $identifier;
        $this->quantity = $quantity;
        $this->options = array();
        $this->properties = array();
    }

    /**
     * Set name
     *
     * @param int $name
     *
     * @return ItemBuilder
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set description
     *
     * @param int $description
     *
     * @return ItemBuilder
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set value
     *
     * @param int $value
     *
     * @return ItemBuilder
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Add Option
     *
     * @param string $name         Name
     * @param string $presentation Presentation
     * @param string $value        Value
     *
     * @return ItemBuilder
     */
    public function addOption($name, $presentation, $value)
    {
        $this->options[$name] = array($name, $presentation, $value);

        return $this;
    }

    /**
     * Add Property
     *
     * @param string $name         Name
     * @param string $presentation Presentation
     * @param string $value        Value
     *
     * @return ItemBuilder
     */
    public function addProperty($name, $presentation, $value = null)
    {
        $this->properties[$name] = array($name, $presentation, $value);

        return $this;
    }

    /**
     * Build
     *
     * @return Basic
     */
    public function build()
    {
        $options = array_map(function($args) {
            return new ItemOption($args[0], $args[1], $args[2]);
        }, $this->options);

        $properties = array_map(function($args) {
            return new ItemProperty($args[0], $args[1], $args[2]);
        }, $this->properties);

        return new Item(
            $this->identifier,
            $this->quantity,
            $this->name,
            $this->description,
            $this->value,
            $options,
            $properties
        );
    }
}
