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

namespace Lostlink\Ark\Tests\Crypto\Unit\Transactions\Serializers;

use Lostlink\Ark\Tests\Crypto\TestCase;

/**
 * @covers \Lostlink\Ark\Crypto\Transactions\Types\HtlcLock
 */
class HtlcLockTest extends TestCase
{
    /** @test */
    public function it_should_serialize_the_transaction_with_a_passphrase()
    {
        $this->assertSerialized($this->getTransactionFixture('htlc_lock', 'htlc-lock-sign'));
    }

    /** @test */
    public function it_should_serialize_the_transaction_with_a_second_passphrase()
    {
        $this->assertSerialized($this->getTransactionFixture('htlc_lock', 'htlc-lock-secondSign'));
    }
}
