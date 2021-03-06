<?php

namespace Src\Discount\Model\Repository\Eloquent;

use Src\Discount\Model\Business\Contract\IUpdate;
use Src\Discount\Model\Business\DiscountEntity;

final class UpdateRepository implements IUpdate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function update($uuid, DiscountEntity $discount): void
    {
        $this->model
             ->findOrFail($uuid)
             ->update([
                'description' => $discount->description(),
                'start_date' => $discount->startDate(),
                'end_date' => $discount->endDate(),
                'uuid' => $discount->uuid(),
                'percent' => $discount->percent()
            ]);
    }
}