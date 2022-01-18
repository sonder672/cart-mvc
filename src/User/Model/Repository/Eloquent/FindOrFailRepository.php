<?php

namespace Src\User\Model\Repository\Eloquent;

use Src\User\Model\Business\Contract\IFind;

final class FindOrFailRepository implements IFind
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function find($uuid)
    {
        return $this->model->findOrFail($uuid);
    }
}