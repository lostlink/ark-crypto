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

namespace Lostlink\Ark\Crypto\Transactions\Builder;

use Lostlink\Ark\Crypto\Transactions\Types\HtlcClaim;

class HtlcClaimBuilder extends AbstractTransactionBuilder
{
    public function htlcClaimAsset(string $lockTransactionId, string $unlockSecret): self
    {
        $this->transaction->data['asset'] = [
            'claim' => [
                'lockTransactionId' => $lockTransactionId,
                'unlockSecret'      => $unlockSecret,
            ],
        ];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function getType(): int
    {
        return \Lostlink\Ark\Crypto\Enums\Types::HTLC_CLAIM;
    }

    protected function getTypeGroup(): int
    {
        return \Lostlink\Ark\Crypto\Enums\TypeGroup::CORE;
    }

    protected function getTransactionInstance(): object
    {
        return new HtlcClaim();
    }
}
