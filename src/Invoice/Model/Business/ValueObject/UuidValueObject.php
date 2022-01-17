<?php

namespace Src\Invoice\Model\Business\ValueObject;

use Src\Invoice\Model\Business\Exception\UuidException;

final class UuidValueObject
{
    private $uuid;

    public function __construct(string $uuid)
    {
        $this->setUuid($uuid);
    }

    public function uuid()
    {
        return $this->uuid;
    }

    private function setUuid($uuid)
    {
        if (strlen($uuid) != 36)
        {
            throw new UuidException('Uuid inválido');
        }
        $this->uuid = $uuid;
    }
}