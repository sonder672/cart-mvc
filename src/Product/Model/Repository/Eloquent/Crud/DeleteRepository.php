<?php

namespace Src\Product\Model\Repository\Eloquent\Crud;

use Src\Product\Model\Business\Contract\Crud\IDelete;

final class DeleteRepository implements IDelete
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function delete($uuid): void
    {
        $this->model
             ->findOrfail($uuid)
             ->delete();
    }
}