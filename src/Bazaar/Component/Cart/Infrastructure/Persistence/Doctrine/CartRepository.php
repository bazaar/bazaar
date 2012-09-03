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

use Bazaar\Component\Cart\Domain\Model\CartInterface;
use Bazaar\Component\Cart\Domain\Model\CartRepositoryInterface;
use Bazaar\Component\Common\Domain\Model\SessionInterface;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Cart Repository.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class CartRepository implements CartRepositoryInterface
{
    /**
     * Constructor
     *
     * @param SessionInterface $session        Session
     * @param ObjectRepository $cartRepository Cart repository
     */
    public function __construct(SessionInterface $session, ObjectRepository $cartRepository)
    {
        $this->session = $session;
        $this->cartRepository = $cartRepository;
    }
    /**
     * {@inheritdoc}
     */
    public function find($cartIdentifier)
    {
        return $this->cartRepository->find($cartIdentifier);
    }

    /**
     * {@inheritdoc}
     */
    public function store(CartInterface $cart)
    {
        $this->session->persist($cart);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(CartInterface $cart)
    {
        $this->session->remove($cart);
    }
}
