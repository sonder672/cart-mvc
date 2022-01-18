<?php

namespace Src\Discount\Model\Repository\Eloquent;

use Src\Discount\Model\Business\Contract\ISelectAll;

final class SelectAllRepository implements ISelectAll
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
}