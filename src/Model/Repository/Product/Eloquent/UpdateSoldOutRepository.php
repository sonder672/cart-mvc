<?php

namespace Src\Model\Repository\Product\Eloquent;

use Src\Model\Entity\Product\Contract\IUpdateSoldOut;

final class UpdateSoldOutRepository implements IUpdateSoldOut
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function updateSoldOut($uuid): void
    {
        $product = $this->model->findOrFail($uuid);
        
        $product->update([
            'sold_out' => true
        ]);
    }
}