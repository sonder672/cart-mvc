<?php

namespace Src\Discount\Model\Repository\Eloquent;

use Src\Discount\Model\Business\Contract\ICreate;
use Src\Discount\Model\Business\DiscountEntity;

final class CreateRepository implements ICreate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(DiscountEntity $discount): void
    {
        $this->model->create([
            'description' => $discount->description(),
            'start_date' => $discount->startDate(),
            'end_date' => $discount->endDate(),
            'uuid' => $discount->uuid(),
            'percent' => $discount->percent()
        ]);
    }
}