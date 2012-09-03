<?php

/*
 * This file is a part of Bazaar.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bazaar\Component\Cart\Infrastructure\Persistence\Session;

use Bazaar\Component\Cart\Domain\Model\Cart;
use Bazaar\Component\Cart\Domain\Model\CartInterface;
use Bazaar\Component\Cart\Domain\Model\CartProviderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Cart Provider.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class CartProvider implements CartProviderInterface
{
    const SESSION_ATTRIBUTE_NAME = '_dflydev_bazaar.cart';

    /**
     * Cart
     *
     * @var CartInterface
     */
    private $cart;

    /**
     * Session
     *
     * @var SessionInterface
     */
    protected $session;

    /**
     * Constructor
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public function getCart()
    {
        if (null !== $this->cart) {
            return $this->cart;
        }

        if ($this->session->has(self::SESSION_ATTRIBUTE_NAME)) {
            $this->cart = unserialize($this->session->get(self::SESSION_ATTRIBUTE_NAME));

            return $this->cart;
        }

        $this->setCart(new Cart('session'));

        return $this->cart;
    }

    /**
     * {@inheritdoc}
     */
    public function setCart(CartInterface $cart)
    {
        $this->cart = $cart;
        $this->session->set(self::SESSION_ATTRIBUTE_NAME, serialize($cart));
    }

    /**
     * {@inheritdoc}
     */
    public function abandonCart()
    {
        $this->cart = null;
        $this->session->remove(self::SESSION_ATTRIBUTE_NAME);
    }
}
