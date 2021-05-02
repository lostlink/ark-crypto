<?php

declare(strict_types=1);

namespace Lostlink\Ark\Crypto\Transactions\Types;

use BitWasp\Bitcoin\Base58;
use BitWasp\Buffertools\Buffer;
use Konceiver\ByteBuffer\ByteBuffer;

class Mint extends Transaction
{
    public function serialize(array $options = []): ByteBuffer
    {
        $buffer = ByteBuffer::new(24);

        $buffer->writeUInt64(+$this->data['amount']);
        $buffer->writeUInt32($this->data['expiration'] ?? 0);
        $buffer->writeHex(Base58::decodeCheck($this->data['recipientId'])->getHex());

        return $buffer;
    }

    public function deserialize(ByteBuffer $buffer): void
    {
        $this->data['amount']      = (string) $buffer->readUInt64();
        $this->data['expiration']  = $buffer->readUInt32();
        $this->data['recipientId'] = Base58::encodeCheck(new Buffer(hex2bin($buffer->readHex(21 * 2))));
    }

    public function hasVendorField(): bool
    {
        return true;
    }
}
