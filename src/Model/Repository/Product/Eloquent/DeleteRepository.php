<?php

namespace Src\Model\Repository\Product\Eloquent;

use Src\Model\Entity\Product\Contract\IDelete;

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