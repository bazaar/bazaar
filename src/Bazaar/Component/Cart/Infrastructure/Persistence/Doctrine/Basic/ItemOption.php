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

use Bazaar\Component\Cart\Domain\Model\Basic\ItemOption as BaseItemOption;

/**
 * Item Option.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ItemOption extends BaseItemOption
{
    private $item;

    /**
     * Constructor
     *
     * @param Item   $item         Item
     * @param string $name         Name
     * @param string $presentation Presentation
     * @param int    $value        Value
     */
    public function __construct(Item $item, $name, $presentation, $value)
    {
        parent::__construct($name, $presentation, $value);
        $this->item = $item;
    }
}
