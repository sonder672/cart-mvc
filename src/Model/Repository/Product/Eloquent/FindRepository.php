<?php

namespace Src\Model\Repository\Product\Eloquent;

use Src\Model\Entity\Product\Contract\IFind;

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