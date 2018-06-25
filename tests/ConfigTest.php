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

namespace ArkEcosystem\Tests\Crypto;

use ArkEcosystem\Crypto\Config as TestClass;
use ArkEcosystem\Crypto\Networks\Devnet;
use ArkEcosystem\Crypto\Networks\Mainnet;
use ArkEcosystem\Crypto\Networks\Network;

/**
 * This is the config test class.
 *
 * @author Brian Faust <brian@ark.io>
 * @coversNothing
 */
class ConfigTest extends TestCase
{
    /** @test */
    public function it_should_get_the_network()
    {
        $actual = TestClass::getNetwork();

        $this->assertInstanceOf(Network::class, $actual);
    }

    /** @test */
    public function it_should_set_the_network()
    {
        $actual = TestClass::getNetwork();
        $this->assertInstanceOf(Mainnet::class, $actual);

        TestClass::setNetwork(Devnet::create());

        $actual = TestClass::getNetwork();
        $this->assertInstanceOf(Devnet::class, $actual);
    }
}
