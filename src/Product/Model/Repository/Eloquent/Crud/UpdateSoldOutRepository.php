<?php

namespace Src\Product\Model\Repository\Eloquent\Crud;

use Src\Product\Model\Business\Contract\Crud\IUpdateSoldOut;

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