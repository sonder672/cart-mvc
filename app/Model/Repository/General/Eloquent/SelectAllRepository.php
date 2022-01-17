<?php

namespace Src\Model\Repository\General\Eloquent;

final class SelectAllRepository
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