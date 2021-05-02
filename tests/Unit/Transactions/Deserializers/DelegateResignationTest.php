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

namespace Lostlink\Ark\Tests\Crypto\Unit\Transactions\Deserializers;

use Lostlink\Ark\Crypto\Transactions\Deserializer;
use Lostlink\Ark\Crypto\Transactions\Types\DelegateResignation;
use ArkEcosystem\Tests\Crypto\TestCase;

/**
 * This is the delegate resignation deserializer test class.
 *
 * @author Brian Faust <brian@ark.io>
 * @covers \Lostlink\Ark\Crypto\Transactions\Types\DelegateResignation
 */
class DelegateResignationTest extends TestCase
{
    /** @test */
    public function it_should_deserialize_the_transaction_signed_with_a_passphrase()
    {
        $transaction = $this->getTransactionFixture('delegate_resignation', 'delegate-resignation-sign');

        $this->assertTransaction($transaction);
    }

    private function assertTransaction(array $fixture): DelegateResignation
    {
        $actual = $this->assertDeserialized($fixture, [
            'version',
            'network',
            'type',
            'typeGroup',
            'nonce',
            'senderPublicKey',
            'fee',
            'asset',
            'signature',
            'secondSignature',
            'amount',
            'id',
        ]);

        $this->assertTrue($actual->verify());

        return $actual;
    }
}
