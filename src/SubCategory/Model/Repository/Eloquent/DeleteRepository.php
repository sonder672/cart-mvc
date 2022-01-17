<?php

namespace Src\SubCategory\Model\Repository\Eloquent;

use Src\SubCategory\Model\Business\Contract\IDelete;

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