<?php

namespace Src\Product\Model\Business\ValueObject;

use Src\Product\Model\Business\Exception\InvalidPriceException;

final class PriceValueObject
{
    private $price;

    public function __construct(int $price)
    {
        $this->setPrice($price);
    }

    public function price()
    {
        return $this->price;
    }

    private function setPrice($price)
    {
        if($price < 1)
        {
            throw new InvalidPriceException('No puede ser negativo');
        }
        $this->price = $price;
    }
}