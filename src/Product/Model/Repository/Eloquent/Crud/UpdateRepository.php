<?php

namespace Src\Product\Model\Repository\Eloquent\Crud;

use Src\Product\Model\Business\Contract\Crud\IUpdate;
use Src\Product\Model\Business\ProductEntity;

final class UpdateRepository implements IUpdate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function update($uuid, ProductEntity $product): void
    {
        $this->model
             ->findOrFail($uuid)
             ->update([
                'name' => $product->name(),
                'price' => $product->price(),
                'stock' => $product->stock(),
                'uuid_sub_category' => $product->uuidSubCategory()
            ]);
    }
}