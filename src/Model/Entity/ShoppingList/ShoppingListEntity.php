<?php

namespace Src\Model\Entity\ShoppingList;

use Src\Controller\GenerateUuid;
use Src\Model\Entity\ShoppingList\ValueObject\QuantityValueObject;

final class ShoppingListEntity
{
    private $uuid;
    private $price;
    private $quantity;
    private $uuid_product;
    private $uuid_invoice;

    public function __construct(
        int $price, 
        QuantityValueObject $quantity,
        string $uuid_product, 
        $uuid_invoice
        )
    {
        $this->price = $price;
        $this->quantity = $quantity;
        $this->uuid_product = $uuid_product;
        $this->uuid_invoice = $uuid_invoice;
        $this->uuid = (new GenerateUuid())->uuidv4();
    }

    public function price()
    {
        return $this->price;
    }

    public function quantity()
    {
        return $this->quantity->quantity();
    }

    public function uuid()
    {
        return $this->uuid;
    }

    public function uuid_product()
    {
        return $this->uuid_product;
    }

    public function uuid_invoice()
    {
        return $this->uuid_invoice;
    }
}