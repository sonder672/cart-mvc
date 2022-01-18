<?php

namespace Src\Shopping\Model\Repository\Eloquent;

use Src\Shopping\Model\Business\Contract\ISelectByInvoice;

final class SelectByInvoiceRepository implements ISelectByInvoice
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    
    public function findByInvoice($uuid_invoice)
    {
        return $this->model->findOrFail($uuid_invoice)
                        ->shoppingLists;
    }
}