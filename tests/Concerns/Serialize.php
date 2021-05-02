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

namespace Lostlink\Ark\Tests\Crypto\Concerns;

use Lostlink\Ark\Crypto\Transactions\Serializer;
use Lostlink\Ark\Crypto\Transactions\Types\DelegateRegistration;
use Lostlink\Ark\Crypto\Transactions\Types\DelegateResignation;
use Lostlink\Ark\Crypto\Transactions\Types\HtlcClaim;
use Lostlink\Ark\Crypto\Transactions\Types\HtlcLock;
use Lostlink\Ark\Crypto\Transactions\Types\HtlcRefund;
use Lostlink\Ark\Crypto\Transactions\Types\IPFS;
use Lostlink\Ark\Crypto\Transactions\Types\MultiPayment;
use Lostlink\Ark\Crypto\Transactions\Types\MultiSignatureRegistration;
use Lostlink\Ark\Crypto\Transactions\Types\SecondSignatureRegistration;
use Lostlink\Ark\Crypto\Transactions\Types\Transfer;
use Lostlink\Ark\Crypto\Transactions\Types\Vote;

trait Serialize
{
    private $transactionsClasses = [
        Transfer::class,
        SecondSignatureRegistration::class,
        DelegateRegistration::class,
        Vote::class,
        MultiSignatureRegistration::class,
        IPFS::class,
        MultiPayment::class,
        DelegateResignation::class,
        HtlcLock::class,
        HtlcClaim::class,
        HtlcRefund::class,
    ];

    protected function assertSerialized(array $fixture): void
    {
        $data              = $fixture['data'];
        $transactionClass  = $this->transactionsClasses[$fixture['data']['type']];
        $transaction       = new $transactionClass();
        $transaction->data = $data;

        $actual = Serializer::new($transaction)->serialize();

        $this->assertSame($fixture['serialized'], $actual->getHex());
    }
}
