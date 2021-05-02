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

use Lostlink\Ark\Crypto\Transactions\Types\HtlcRefund;

class HtlcRefundBuilder extends AbstractTransactionBuilder
{
    public function htlcRefundAsset(string $lockTransactionId): self
    {
        $this->transaction->data['asset'] = [
            'refund' => [
                'lockTransactionId' => $lockTransactionId,
            ],
        ];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function getType(): int
    {
        return \Lostlink\Ark\Crypto\Enums\Types::HTLC_REFUND;
    }

    protected function getTypeGroup(): int
    {
        return \Lostlink\Ark\Crypto\Enums\TypeGroup::CORE;
    }

    protected function getTransactionInstance(): object
    {
        return new HtlcRefund();
    }
}
