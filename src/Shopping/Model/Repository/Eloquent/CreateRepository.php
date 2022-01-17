<?php

namespace Src\Shopping\Model\Repository\Eloquent;

use Src\Shopping\Model\Business\Contract\ICreate;
use Src\Shopping\Model\Business\ShoppingListEntity;

final class CreateRepository implements ICreate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(ShoppingListEntity $list): void
    {
        $this->model->create([
            'price' => $list->price(),
            'quantity' => $list->quantity(),
            'uuid_product' => $list->uuid_product(),
            'uuid_invoice' => $list->uuid_invoice(),
            'uuid' => $list->uuid()
        ]);
    }
}