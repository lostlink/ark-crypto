<?php

declare(strict_types=1);

/*
 * This file is part of Ark PHP Crypto.
 *
 * (c) Ark Ecosystem <info@ark.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lostlink\Ark\Crypto\Configuration;

use Lostlink\Ark\Crypto\Networks\AbstractNetwork;
use Lostlink\Ark\Crypto\Networks\Devnet;
use BitWasp\Bitcoin\Bitcoin;

/**
 * This is the network configuration class.
 *
 * @author Brian Faust <brian@ark.io>
 */
class Network
{
    /**
     * The network used for crypto operations.
     *
     * @var \Lostlink\Ark\Crypto\Networks\AbstractNetwork
     */
    private static $network;

    /**
     * Call a method on the network instance.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public static function __callStatic(string $method, array $args)
    {
        return static::get()->{$method}(...$args);
    }

    /**
     * Get the network used for crypto operations.
     *
     * @return \Lostlink\Ark\Crypto\Networks\AbstractNetwork
     */
    public static function get(): AbstractNetwork
    {
        return static::$network ?? Devnet::new();
    }

    /**
     * Set the network used for crypto operations.
     *
     * @param \Lostlink\Ark\Crypto\Networks\AbstractNetwork $network
     */
    public static function set(AbstractNetwork $network): void
    {
        static::$network = $network;

        Bitcoin::setNetwork($network);
    }
}
