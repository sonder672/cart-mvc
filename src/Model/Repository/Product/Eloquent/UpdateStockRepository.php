<?php

namespace Src\Model\Repository\Product\Eloquent;

use Src\Model\Entity\Product\Contract\ISubtractStock;

final class UpdateStockRepository implements ISubtractStock
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function update($uuid, $quantity): void
    {
        $product = $this->model->findOrFail($uuid);
        
        $product->update([
            'stock' => $product->stock - $quantity
        ]);
    }
}