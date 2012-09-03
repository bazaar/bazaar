<?php

/*
 * This file is a part of Bazaar.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bazaar\Component\Common\Domain\Service;

/**
 * Identity Generator Service Interface.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
interface IdentityGeneratorServiceInterface
{
    /**
     * Generate identity.
     *
     * @param string $suggestion Requested identity
     *
     * @return string
     */
    public function generateIdentity($suggestion = null);
}
