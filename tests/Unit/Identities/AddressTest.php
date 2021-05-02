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

namespace ArkEcosystem\Tests\Crypto\Unit\Identities;

use Lostlink\Ark\Crypto\Configuration\Network;
use Lostlink\Ark\Crypto\Identities\Address as TestClass;
use Lostlink\Ark\Crypto\Identities\PrivateKey;
use Lostlink\Ark\Crypto\Networks\Devnet;
use ArkEcosystem\Tests\Crypto\TestCase;

/**
 * This is the address test class.
 *
 * @author Brian Faust <brian@ark.io>
 * @covers \Lostlink\Ark\Crypto\Identities\Address
 */
class AddressTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Network::set(Devnet::new());
    }

    /** @test */
    public function it_should_get_the_address_from_passphrase()
    {
        $fixture = $this->getFixture('identity');

        $actual = TestClass::fromPassphrase($fixture['passphrase']);

        $this->assertSame($fixture['data']['address'], $actual);
    }

    /** @test */
    public function it_should_get_the_address_from_a_multi_signature_asset()
    {
        $actual = TestClass::fromMultiSignatureAsset(3, [
            '02fb3def2593a00c5b84620addf28ff21bac452bd71a37d4d8e24f301683a81b56',
            '02bc9f661fcc8abca65fe9aff4614036867b7fdcc5730085ccc5cb854664d0194b',
            '03c44c6b6cc9893ae21ca606712fd0f6f03c41ce81c4f6ce5a640f4b0b82ec1ce0',
            '020300039e973baf5e46b945777cfae330d6392cdb039b1cebc5c3382d421166c3',
            '03b050073621b9b5caec9461d44d6bcf21a858c47dd88230ce723e25c1bc75c219',
        ]);

        $this->assertSame('DMNBBtYt1teAKxA2BpiTW9PA3gX3Ad5dyk', $actual);
    }

    /** @test */
    public function it_should_get_the_address_from_public_key()
    {
        $fixture = $this->getFixture('identity');

        $actual = TestClass::fromPublicKey($fixture['data']['publicKey']);

        $this->assertSame($fixture['data']['address'], $actual);
    }

    /** @test */
    public function it_should_get_the_address_from_private_key()
    {
        $fixture = $this->getFixture('identity');

        $privateKey = PrivateKey::fromPassphrase($fixture['passphrase']);

        $actual = TestClass::fromPrivateKey($privateKey);

        $this->assertSame($fixture['data']['address'], $actual);
    }

    /** @test */
    public function it_should_validate_the_address()
    {
        $fixture = $this->getFixture('identity');

        $actual = TestClass::validate($fixture['data']['address']);

        $this->assertTrue($actual);
    }

    /** @test */
    public function it_should_fail_to_validate_the_address()
    {
        $actual = TestClass::validate('invalid');

        $this->assertFalse($actual);
    }
}
