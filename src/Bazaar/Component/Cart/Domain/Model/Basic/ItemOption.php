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
 * Item Option.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ItemOption
{
    protected $name;
    protected $presentation;
    protected $value;

    /**
     * Constructor
     *
     * @param string $name         Name
     * @param string $presentation Presentation
     * @param int    $value        Value
     */
    public function __construct($name, $presentation, $value)
    {
        $this->name = $name;
        $this->presentation = $presentation;
        $this->value = $value;
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
     * Presentation
     *
     * @return string
     */
    public function presentation()
    {
        return $this->presentation;
    }

    /**
     * Value
     *
     * @return string
     */
    public function value()
    {
        return $this->value;
    }
}
