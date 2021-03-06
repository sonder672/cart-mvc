<?php

namespace Src\SubCategory\Model\Repository\Eloquent;

use Src\SubCategory\Model\Business\Contract\IFindByDiscount;

final class FindByDiscount implements IFindByDiscount
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function findByDiscount($uuid_sub_category)
    {
        return $this->model->find($uuid_sub_category)
            ->discount()->pluck('percent')->first();
    }
}