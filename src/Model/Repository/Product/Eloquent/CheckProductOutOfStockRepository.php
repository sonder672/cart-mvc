<?php

namespace Src\Model\Repository\Product\Eloquent;

use Src\Model\Entity\Product\Contract\ICheckProductOutOfStock;

final class CheckProductOutOfStockRepository implements ICheckProductOutOfStock
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function soldOut($uuid)
    {
        $product = $this->model->findOrFail($uuid);

        return $product->soldOut;
    }
}