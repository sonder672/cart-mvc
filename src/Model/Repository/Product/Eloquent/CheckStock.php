<?php

namespace Src\Model\Repository\Product\Eloquent;

use Src\Model\Entity\Product\Contract\ICheckStock;

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