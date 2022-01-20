<?php

namespace Src\SubCategory\Model\Repository\Eloquent;

use Src\SubCategory\Model\Business\Contract\IFind;

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