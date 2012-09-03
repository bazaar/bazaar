<?php

/*
 * This file is a part of Bazaar.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bazaar\Component\Cart\Tests\Domain\Model;

use Bazaar\Component\Cart\Domain\Model\CartProvider;

/**
 * CartProvider test
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class CartProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getCart() method with valid existing cart identifier.
     */
    public function testGetValidExistingIdentifier()
    {
        $cartStorage = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartStorageInterface');
        $cartFactory = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartFactoryInterface');
        $cartRepository = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartRepositoryInterface');

        $cart = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartInterface');

        $cartStorage
            ->expects($this->once())
            ->method('getCurrentCartIdentifier')
            ->will($this->returnValue('asdf1234'));

        $cartRepository
            ->expects($this->once())
            ->method('find')
            ->with('asdf1234');

        $cartFactory
            ->expects($this->once())
            ->method('createCart')
            ->will($this->returnValue($cart));

        $cartRepository
            ->expects($this->once())
            ->method('store')
            ->with($cart);

        $cart
            ->expects($this->once())
            ->method('identifier')
            ->will($this->returnValue('asdf1234'));

        $cartStorage
            ->expects($this->once())
            ->method('setCurrentCartIdentifier')
            ->with('asdf1234');

        $cartProvider = new CartProvider($cartStorage, $cartFactory, $cartRepository);

        // This time should come from storage + repository.
        $this->assertEquals($cart, $cartProvider->getCart());

        // This time should come from cache.
        $this->assertEquals($cart, $cartProvider->getCart());
    }

    /**
     * Test getCart() method with invalid existing cart identifier.
     */
    public function testGetInvalidExistingIdentifier()
    {
        $cartStorage = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartStorageInterface');
        $cartFactory = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartFactoryInterface');
        $cartRepository = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartRepositoryInterface');

        $cart = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartInterface');

        $cartStorage
            ->expects($this->once())
            ->method('getCurrentCartIdentifier')
            ->will($this->returnValue('asdf1234'));

        $cartRepository
            ->expects($this->once())
            ->method('find')
            ->with('asdf1234')
            ->will($this->returnValue($cart));

        $cartProvider = new CartProvider($cartStorage, $cartFactory, $cartRepository);

        // This time should come from storage + repository.
        $this->assertEquals($cart, $cartProvider->getCart());

        // This time should come from cache.
        $this->assertEquals($cart, $cartProvider->getCart());
    }

    /**
     * Test setCart() method.
     */
    public function testSetCart()
    {
        $cartStorage = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartStorageInterface');
        $cartFactory = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartFactoryInterface');
        $cartRepository = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartRepositoryInterface');

        $cart = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartInterface');

        $cartStorage
            ->expects($this->once())
            ->method('setCurrentCartIdentifier')
            ->with('asdf1234');

        $cartStorage
            ->expects($this->never())
            ->method('getCurrentCartIdentifier');

        $cart
            ->expects($this->once())
            ->method('identifier')
            ->will($this->returnValue('asdf1234'));

        $cartProvider = new CartProvider($cartStorage, $cartFactory, $cartRepository);

        $cartProvider->setCart($cart);

        $this->assertEquals($cart, $cartProvider->getCart());
    }

    /**
     * Test abandonCart() method.
     */
    public function testAbandonCart()
    {
        $cartStorage = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartStorageInterface');
        $cartFactory = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartFactoryInterface');
        $cartRepository = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartRepositoryInterface');

        $cart = $this->getMock('Bazaar\Component\Cart\Domain\Model\CartInterface');

        $cartStorage
            ->expects($this->once())
            ->method('abandonCurrentCart');

        $cartStorage
            ->expects($this->once())
            ->method('getCurrentCartIdentifier')
            ->will($this->throwException(new \Exception('Called because abandon cart worked (cart is null)')));

        $cartProvider = new CartProvider($cartStorage, $cartFactory, $cartRepository);

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
