<?php

namespace Src\Model\Entity\ShoppingList\ValueObject;

use Src\Model\Entity\ShoppingList\Exception\QuantityException;

final class QuantityValueObject
{
    private $quantity;

    public function __construct(int $quantity)
    {
        $this->setQuantity($quantity);
    }

    public function quantity()
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        if ($quantity > 9)
        {
            throw new QuantityException('Cantidad excesiva del producto');
        }
        $this->quantity = $quantity;
    }
}