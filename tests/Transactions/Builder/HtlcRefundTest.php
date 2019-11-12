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

namespace ArkEcosystem\Tests\Crypto\Transactions\Builder;

use ArkEcosystem\Tests\Crypto\TestCase;
use ArkEcosystem\Crypto\Identities\PublicKey;
use ArkEcosystem\Crypto\Transactions\Builder\HtlcRefundBuilder;

/**
 * This is the delegate registration builder test class.
 *
 * @author Brian Faust <brian@ark.io>
 * @covers \ArkEcosystem\Crypto\Transactions\Builder\HtlcRefund
 */
class HtlcRefundTest extends TestCase
{
    /** @test */
    public function it_should_sign_it_with_a_passphrase()
    {
        $transaction = HtlcRefundBuilder::new()
            ->htlcRefundAsset("fe1a1b3b117c28078c5d3c42ffb9492234afc01d15b08c047feccf0b6bee0f78")
            ->sign($this->passphrase);

        $this->assertTrue($transaction->verify());
    }

    /** @test */
    public function it_should_sign_it_with_a_second_passphrase()
    {
        $secondPassphrase = 'this is a top secret second passphrase';

        $transaction = HtlcRefundBuilder::new()
            ->htlcRefundAsset("fe1a1b3b117c28078c5d3c42ffb9492234afc01d15b08c047feccf0b6bee0f78")
            ->sign($this->passphrase)
            ->secondSign($secondPassphrase);

        $this->assertTrue($transaction->verify());
        $this->assertTrue($transaction->secondVerify(PublicKey::fromPassphrase($secondPassphrase)->getHex()));
    }
}
