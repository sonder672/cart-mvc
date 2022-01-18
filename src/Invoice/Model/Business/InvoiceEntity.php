<?php

namespace Src\Invoice\Model\Business;

use Src\Invoice\Model\Business\ValueObject\UuidValueObject;

final class InvoiceEntity
{
    private $price;
    private $uuid;
    private $uuid_customer;

    public function __construct(int $price, UuidValueObject $uuid)
    {
        $this->price = $price;
        $this->uuid = $uuid;
        $this->uuid_customer = $_SESSION['uuid'];
    }

    public function price()
    {
        return $this->price;
    }

    public function uuid()
    {
        return $this->uuid->uuid();
    }

    public function uuidCustomer()
    {
        return $this->uuid_customer;
    }
}