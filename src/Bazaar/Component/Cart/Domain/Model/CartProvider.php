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

/**
 * Cart Provider.
 *
 * Basic implementation of a Cart Provider.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class CartProvider implements CartProviderInterface
{
    /**
     * Cart
     *
     * @var CartInterface
     */
    private $cart;

    /**
     * Cart Storage
     *
     * @var CartStorageInterface
     */
    protected $cartStorage;

    /**
     * Cart Factory
     *
     * @var CartFactoryInterface
     */
    protected $cartFactory;

    /**
     * Cart Repository
     *
     * @var CartRepository
     */
    protected $cartRepository;

    /**
     * Constructor
     *
     * @param CartStorageInterface    $cartStorage    Cart Storage
     * @param CartFactoryInterface    $cartFactory    Cart Factory
     * @param CartRepositoryInterface $cartRepository Cart Repository
     */
    public function __construct(CartStorageInterface $cartStorage, CartFactoryInterface $cartFactory, CartRepositoryInterface $cartRepository)
    {
        $this->cartStorage = $cartStorage;
        $this->cartFactory = $cartFactory;
        $this->cartRepository = $cartRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getCart()
    {
        if (null !== $this->cart) {
            return $this->cart;
        }

        if ($cartIdentifier = $this->cartStorage->getCurrentCartIdentifier()) {
            $cart = $this->cartRepository->find($cartIdentifier);

            if ($cart) {
                $this->cart = $cart;

                return $this->cart;
            }
        }

        $cart = $this->cartFactory->createCart();
        $this->cartRepository->store($cart);
        $this->cartStorage->setCurrentCartIdentifier($cart->identifier());

        $this->cart = $cart;

        return $this->cart;
    }

    /**
     * {@inheritdoc}
     */
    public function setCart(CartInterface $cart)
    {
        $this->cart = $cart;
        $this->cartStorage->setCurrentCartIdentifier($cart->identifier());
    }

    /**
     * {@inheritdoc}
     */
    public function abandonCart()
    {
        $this->cart = null;
        $this->cartStorage->abandonCurrentCart();
    }
}
