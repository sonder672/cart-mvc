<?php

namespace Src\Shopping\Model\Business\ValueObject;

use Src\Shopping\Model\Business\Exception\QuantityException;

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
        if ($quantity > 5)
        {
            throw new QuantityException('Cantidad excesiva del producto');
        }
        $this->quantity = $quantity;
    }
}