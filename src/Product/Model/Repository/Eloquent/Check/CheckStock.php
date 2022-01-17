<?php

namespace Src\Product\Model\Repository\Eloquent\Check;

use Src\Product\Model\Business\Contract\Check\ICheckStock;

final class CheckStock implements ICheckStock
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function stock($uuid)
    {
        $product = $this->model->findOrFail($uuid);

        return $product->stock;
    }
}