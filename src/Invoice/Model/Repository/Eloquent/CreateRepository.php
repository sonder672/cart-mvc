<?php

namespace Src\Invoice\Model\Repository\Eloquent;

use Src\Invoice\Model\Business\Contract\ICreate;
use Src\Invoice\Model\Business\InvoiceEntity;

final class CreateRepository implements ICreate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(InvoiceEntity $invoice): void
    {
        $this->model->create([
            'uuid' => $invoice->uuid(),
            'price' => $invoice->price(),
        ]);
    }
}