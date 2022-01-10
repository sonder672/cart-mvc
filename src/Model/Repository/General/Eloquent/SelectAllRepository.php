<?php

namespace Src\Model\Repository\General\Eloquent;

use Src\Model\Contract\ISelectAll;

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