<?php

namespace Src\Product\Model\Repository\Eloquent\Crud;

use Src\Product\Model\Business\Contract\Crud\IFind;

final class FindRepository implements IFind
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function findOrFail($uuid)
    {
        return $this->model->findOrFail($uuid);
    }
}