<?php

/*
 * This file is a part of Bazaar.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bazaar\Component\Cart\Tests\Infrastructure\Persistence\Session;

use Bazaar\Component\Cart\Infrastructure\Persistence\Session\CartStorage;

/**
 * Cart Storage Test.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class CartStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setup
     */
    public function setUp()
    {
        if (!interface_exists('Symfony\Component\HttpFoundation\Session\SessionInterface')) {
            $this->markTestSkipped('The Symfony HttpFoundation library is not available');
        }
    }

    /**
     * Test getCurrentCartIdentifier() method.
     */
    public function testGetCurrentCartIdentifier()
    {
        $session = $this->getMock('Symfony\Component\HttpFoundation\Session\SessionInterface');

        $session
            ->expects($this->once())
            ->method('get')
            ->with(CartStorage::SESSION_ATTRIBUTE_NAME)
            ->will($this->returnValue('asdf1234'));

        $cartStorage = new CartStorage($session);

        $this->assertEquals('asdf1234', $cartStorage->getCurrentCartIdentifier());
    }
    /**
     * Test setCurrentCartIdentifier() method.
     */

    public function testSetCurrentCartIdentifier()
    {
        $session = $this->getMock('Symfony\Component\HttpFoundation\Session\SessionInterface');

        $session
            ->expects($this->once())
            ->method('set')
            ->with(CartStorage::SESSION_ATTRIBUTE_NAME, 'asdf1234');

        $cartStorage = new CartStorage($session);

        $cartStorage->setCurrentCartIdentifier('asdf1234');
    }

    /**
     * Test abandonCurrentCart() method.
     */
    public function testAbandonCurrentCart()
    {
        $session = $this->getMock('Symfony\Component\HttpFoundation\Session\SessionInterface');

        $session
            ->expects($this->once())
            ->method('remove')
            ->with(CartStorage::SESSION_ATTRIBUTE_NAME);

        $cartStorage = new CartStorage($session);

        $cartStorage->abandonCurrentCart();
    }
}
