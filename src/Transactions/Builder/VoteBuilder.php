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

use Lostlink\Ark\Crypto\Configuration\Network;
use Lostlink\Ark\Crypto\Identities\Address;
use Lostlink\Ark\Crypto\Transactions\Types\Vote;

/**
 * This is the vote transaction class.
 *
 * @author Brian Faust <brian@ark.io>
 */
class VoteBuilder extends AbstractTransactionBuilder
{
    /**
     * Create a new multi signature transaction instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->transaction->data['asset'] = [];
    }

    /**
     * Set the votes to cast.
     *
     * @param array $votes
     *
     * @return self
     */
    public function votes(array $votes): self
    {
        $this->transaction->data['asset']['votes'] = $votes;

        return $this;
    }

    /**
     * Sign the transaction using the given passphrase.
     *
     * @param string $passphrase
     *
     * @return self
     */
    public function sign(string $passphrase): AbstractTransactionBuilder
    {
        $this->transaction->data['recipientId'] = Address::fromPassphrase($passphrase, Network::get());

        parent::sign($passphrase);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function getType(): int
    {
        return \Lostlink\Ark\Crypto\Enums\Types::VOTE;
    }

    protected function getTypeGroup(): int
    {
        return \Lostlink\Ark\Crypto\Enums\TypeGroup::CORE;
    }

    protected function getTransactionInstance(): object
    {
        return new Vote();
    }
}
