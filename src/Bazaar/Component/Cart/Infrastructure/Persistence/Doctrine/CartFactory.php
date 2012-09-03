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

use Bazaar\Component\Cart\Domain\Model\AbstractCartFactory;

/**
 * Cart Factory.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class CartFactory extends AbstractCartFactory
{
    /**
     * Class that should be created
     *
     * @var string
     */
    private $class = 'Bazaar\Component\Cart\Infrastructure\Persistence\Doctrine\Cart';

    /**
     * {@inheritdoc}
     */
    public function createCartInternal($cartIdentifier, $class = null)
    {
        $class = $class ?: $this->class;

        return new $class($cartIdentifier);
    }
}
