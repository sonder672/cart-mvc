<?php

namespace Src\Model\Entity\Product\ValueObject;

use Src\Model\Entity\Product\Exception\InvalidStockException;

final class StockValueObject
{
    private $stock;

    public function __construct(int $stock)
    {
        $this->setStock($stock);
    }

    public function stock()
    {
        return $this->stock;
    }

    private function setStock($stock)
    {
        if($stock < 1)
        {
            throw new InvalidStockException('Cantidad del producto inválida');
        }
        $this->stock = $stock;
    }
}