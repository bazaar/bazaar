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

use Bazaar\Component\Cart\Infrastructure\Persistence\Session\CartProvider;

/**
 * Cart Provider Test.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class CartProviderTest extends \PHPUnit_Framework_TestCase
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
     * Test getCart() method. (existing cart)
     */
    public function testGetExistingCart()
    {
        $session = $this->getMock('Symfony\Component\HttpFoundation\Session\SessionInterface');

        $cart = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartInterface');

        $cart
            ->expects($this->any())
            ->method('identifier')
            ->will($this->returnValue('session'));

        $session
            ->expects($this->once())
            ->method('has')
            ->with(CartProvider::SESSION_ATTRIBUTE_NAME)
            ->will($this->returnValue(true));

        $session
            ->expects($this->once())
            ->method('get')
            ->with(CartProvider::SESSION_ATTRIBUTE_NAME)
            ->will($this->returnValue(serialize($cart)));

        $cartProvider = new CartProvider($session);

        // This time should come from session.
        $this->assertEquals($cart->identifier(), $cartProvider->getCart()->identifier());

        // This time should come from cache.
        $this->assertEquals($cart->identifier(), $cartProvider->getCart()->identifier());
    }

    /**
     * Test getCart() method. (new cart)
     */
    public function testGetNewCart()
    {
        $session = $this->getMock('Symfony\Component\HttpFoundation\Session\SessionInterface');

        $session
            ->expects($this->once())
            ->method('has')
            ->with(CartProvider::SESSION_ATTRIBUTE_NAME)
            ->will($this->returnValue(false));

        $session
            ->expects($this->once())
            ->method('set');

        $cartProvider = new CartProvider($session);

        // This time should come from session.
        $this->assertEquals('session', $cartProvider->getCart()->identifier());

        // This time should come from cache.
        $this->assertEquals('session', $cartProvider->getCart()->identifier());
    }

    /**
     * Test setCart() method.
     */
    public function testSetCart()
    {
        $session = $this->getMock('Symfony\Component\HttpFoundation\Session\SessionInterface');

        $cart = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartInterface');

        $session
            ->expects($this->once())
            ->method('set')
            ->with(CartProvider::SESSION_ATTRIBUTE_NAME, serialize($cart));

        $cartProvider = new CartProvider($session);

        $cartProvider->setCart($cart);

        $this->assertEquals($cart, $cartProvider->getCart());
    }

    /**
     * Test abandonCart() method.
     */
    public function testAbandonCart()
    {
        $session = $this->getMock('Symfony\Component\HttpFoundation\Session\SessionInterface');

        $cart = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartInterface');

        $session
            ->expects($this->once())
            ->method('remove')
            ->with(CartProvider::SESSION_ATTRIBUTE_NAME);

        $session
            ->expects($this->once())
            ->method('has')
            ->will($this->throwException(new \Exception('Called because abandon cart worked (cart is null)')));

        $cartProvider = new CartProvider($session);

        $cartProvider->setCart($cart);

        $cartProvider->abandonCart();

        try {
            $cartProvider->getCart();

            $this->fail('The call to getCart did not throw the test exception');
        } catch (\Exception $e) {
            $this->assertEquals('Called because abandon cart worked (cart is null)', $e->getMessage());
        }

    }
}
