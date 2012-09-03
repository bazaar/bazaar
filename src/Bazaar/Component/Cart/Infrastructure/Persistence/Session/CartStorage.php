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

use Bazaar\Component\Cart\Domain\Model\CartStorageInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Cart Provider.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class CartStorage implements CartStorageInterface
{
    const SESSION_ATTRIBUTE_NAME = '_dflydev_bazaar.cart_id';

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
    public function getCurrentCartIdentifier()
    {
        return $this->session->get(self::SESSION_ATTRIBUTE_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrentCartIdentifier($cartIdentifier)
    {
        $this->session->set(self::SESSION_ATTRIBUTE_NAME, $cartIdentifier);
    }

    /**
     * {@inheritdoc}
     */
    public function abandonCurrentCart()
    {
        $this->session->remove(self::SESSION_ATTRIBUTE_NAME);
    }
}
