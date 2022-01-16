<?php

namespace Src\Model\Repository\Invoice\Eloquent;

use Src\Model\Entity\Invoice\Contract\ICreate;
use Src\Model\Entity\Invoice\InvoiceEntity;

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