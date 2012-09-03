<?php

/*
 * This file is a part of Bazaar.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bazaar\Component\Cart\Tests\Infrastructure\Persistence\Doctrine;

use Bazaar\Component\Cart\Infrastructure\Persistence\Doctrine\CartFactory;

/**
 * Cart Factory Test.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class CartFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test create() method. (default class)
     */
    public function testCreateDefaultClass()
    {
        $identityGenerator = $this->getMock('Bazaar\Component\Common\Domain\Service\IdentityGeneratorServiceInterface');

        $identityGenerator
            ->expects($this->once())
            ->method('generateIdentity')
            ->will($this->returnValue('asdf1234'));

        $cartFactory = new CartFactory($identityGenerator);

        $cart = $cartFactory->createCart();

        $this->assertEquals('asdf1234', $cart->identifier());
    }

    /**
     * Test create() method. (custom class)
     */
    public function testCreateCustomClass()
    {
        $identityGenerator = $this->getMock('Bazaar\Component\Common\Domain\Service\IdentityGeneratorServiceInterface');

        $identityGenerator
            ->expects($this->once())
            ->method('generateIdentity')
            ->will($this->returnValue('asdf1234'));

        $cartFixtureClass = 'Bazaar\Component\Cart\Tests\Infrastructure\Persistence\Doctrine\Fixtures\CustomCart';

        $cartFactory = new CartFactory($identityGenerator, $cartFixtureClass);

        $cart = $cartFactory->createCart();

        $this->assertEquals('asdf1234', $cart->identifier());
        $this->assertInstanceOf($cartFixtureClass, $cart);
    }
}
