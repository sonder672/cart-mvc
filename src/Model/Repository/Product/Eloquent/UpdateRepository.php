<?php

namespace Src\Model\Repository\Product\Eloquent;

use Src\Model\Entity\Product\Contract\IUpdate;
use Src\Model\Entity\Product\ProductEntity;

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