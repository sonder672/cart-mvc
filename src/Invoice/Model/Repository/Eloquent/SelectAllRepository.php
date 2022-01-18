<?php

namespace Src\Invoice\Model\Repository\Eloquent;

use Src\Invoice\Model\Business\Contract\ISelectAll;

final class SelectAllRepository implements ISelectAll
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->findOrFail($_SESSION['uuid'])
                    ->invoices;
    }
}