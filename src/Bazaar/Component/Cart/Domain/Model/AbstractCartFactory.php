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

use Bazaar\Component\Common\Domain\Service\IdentityGeneratorServiceInterface;

/**
 * Abstract Cart Factory.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
abstract class AbstractCartFactory implements CartFactoryInterface
{
    /**
     * Identity Generator
     *
     * @var IdentityGeneratorServiceInterface
     */
    protected $identityGenerator;

    /**
     * Class to create
     *
     * @var string
     */
    private $class;

    /**
     * Constructor
     *
     * @param IdentityGeneratorServiceInterface $identityGenerator Identity Generator
     * @param string                            $class             Class to create
     */
    public function __construct(IdentityGeneratorServiceInterface $identityGenerator, $class = null)
    {
        $this->identityGenerator = $identityGenerator;
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function createCart()
    {
        $cartIdentifier = $this->identityGenerator->generateIdentity();

        return $this->createCartInternal($cartIdentifier, $this->class);
    }

    /**
     * Create Cart (internal).
     *
     * @param string $cartIdentifier Cart identifier
     * @param string $class          Class to create
     *
     * @return CartInterface
     */
    abstract protected function createCartInternal($cartIdentifier, $class = null);
}
