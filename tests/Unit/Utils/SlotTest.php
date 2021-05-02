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

namespace Lostlink\Ark\Tests\Crypto\Unit\Utils;

use Lostlink\Ark\Crypto\Utils\Slot;
use Lostlink\Ark\Tests\Crypto\TestCase;

/**
 * This is the slot test class.
 *
 * @author Brian Faust <brian@ark.io>
 * @covers \Lostlink\Ark\Crypto\Utils\Slot
 */
class SlotTest extends TestCase
{
    /** @test */
    public function it_should_get_the_time()
    {
        $actual = Slot::time();

        $this->assertIsInt($actual);
    }

    /** @test */
    public function it_should_get_the_epoch()
    {
        $actual = Slot::epoch();

        $this->assertIsInt($actual);
    }
}
