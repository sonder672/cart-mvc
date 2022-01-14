<?php

namespace Src\Model\Repository\SubCategory\Eloquent;

use Src\Model\Entity\SubCategory\Contract\IFindByDiscount;

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