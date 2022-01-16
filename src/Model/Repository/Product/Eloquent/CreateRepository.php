<?php

namespace Src\Model\Repository\Product\Eloquent;

use Src\Model\Entity\Product\Contract\ICreate;
use Src\Model\Entity\Product\ProductEntity;

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