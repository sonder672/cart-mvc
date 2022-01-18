<?php

namespace Src\Shopping\Model\Business\Contract;

use Src\Shopping\Model\Business\ShoppingListEntity;

interface ISelectByInvoice
{
    public function findByInvoice($uuid_invoice);
}