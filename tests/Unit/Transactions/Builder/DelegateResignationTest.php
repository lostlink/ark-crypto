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

namespace Lostlink\Ark\Tests\Crypto\Unit\Transactions\Builder;

use Lostlink\Ark\Crypto\Identities\PublicKey;
use Lostlink\Ark\Crypto\Transactions\Builder\DelegateResignationBuilder;
use Lostlink\Ark\Crypto\Transactions\Serializer;
use ArkEcosystem\Tests\Crypto\TestCase;

/**
 * This is the delegate resignation builder test class.
 *
 * @author Brian Faust <brian@ark.io>
 * @covers \Lostlink\Ark\Crypto\Transactions\Builder\DelegateResignationBuilder
 */
class DelegateResignationTest extends TestCase
{
    /** @test */
    public function it_should_sign_it_with_a_passphrase()
    {
        $transaction = DelegateResignationBuilder::new()
            ->sign($this->passphrase);

        $this->assertTrue($transaction->verify());
    }

    /** @test */
    public function it_should_sign_it_with_a_second_passphrase()
    {
        $secondPassphrase = 'this is a top secret second passphrase';

        $transaction = DelegateResignationBuilder::new()
            ->sign($this->passphrase)
            ->secondSign($secondPassphrase);

        $this->assertTrue($transaction->verify());
        $this->assertTrue($transaction->secondVerify(PublicKey::fromPassphrase($secondPassphrase)->getHex()));
    }

    /** @test */
    public function it_should_match_fixture_passphrase()
    {
        $fixture = $this->getTransactionFixture('delegate_resignation', 'delegate-resignation-sign');
        $builder = DelegateResignationBuilder::new()
            ->sign($this->passphrase);

        $this->assertTrue($builder->verify());
        $this->assertSame($fixture['serialized'], Serializer::new($builder->transaction)->serialize()->getHex());
        $this->assertSameTransactions($fixture, $builder->transaction->data);
    }

    /** @test */
    public function it_should_match_fixture_second_passphrase()
    {
        $fixture = $this->getTransactionFixture('delegate_resignation', 'delegate-resignation-secondSign');
        $builder = DelegateResignationBuilder::new()
            ->sign($this->passphrase)
            ->secondSign($this->secondPassphrase);

        $this->assertTrue($builder->verify());
        $this->assertSame($fixture['serialized'], Serializer::new($builder->transaction)->serialize()->getHex());
        $this->assertSameTransactions($fixture, $builder->transaction->data);
    }
}
