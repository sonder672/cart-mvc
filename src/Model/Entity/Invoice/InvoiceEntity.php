<?php

namespace Src\Model\Entity\Invoice;

use Src\Model\Entity\Invoice\ValueObject\UuidValueObject;

final class InvoiceEntity
{
    private $price;
    private $uuid;

    public function __construct(int $price, UuidValueObject $uuid)
    {
        $this->price = $price;
        $this->uuid = $uuid;
    }

    public function price()
    {
        return $this->price;
    }

    public function uuid()
    {
        return $this->uuid->uuid();
    }
}