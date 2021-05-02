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

use Lostlink\Ark\Crypto\Transactions\Types\DelegateResignation;

/**
 * This is the delegate resignation transaction class.
 *
 * @author Brian Faust <brian@ark.io>
 */
class DelegateResignationBuilder extends AbstractTransactionBuilder
{
    protected function getType(): int
    {
        return \Lostlink\Ark\Crypto\Enums\Types::DELEGATE_RESIGNATION;
    }

    protected function getTypeGroup(): int
    {
        return \Lostlink\Ark\Crypto\Enums\TypeGroup::CORE;
    }

    protected function getTransactionInstance(): object
    {
        return new DelegateResignation();
    }
}
