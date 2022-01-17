<?php

namespace Src\Product\Model\Repository\Eloquent\Check;

use Src\Product\Model\Business\Contract\Check\ICheckProductOutOfStock;

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