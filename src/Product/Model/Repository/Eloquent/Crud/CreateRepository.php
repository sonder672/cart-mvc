<?php

namespace Src\Product\Model\Repository\Eloquent\Crud;

use Src\Product\Model\Business\Contract\Crud\ICreate;
use Src\Product\Model\Business\ProductEntity;

final class CreateRepository implements ICreate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(ProductEntity $product): void
    {
        $this->model->create([
            'name' => $product->name(),
            'price' => $product->price(),
            'stock' => $product->stock(),
            'uuid_sub_category' => $product->uuidSubCategory(),
            'uuid' => $product->uuid(),
            'sold_out' => $product->soldOut()
        ]);
    }
}