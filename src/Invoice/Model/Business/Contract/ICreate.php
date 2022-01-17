<?php

namespace Src\Invoice\Model\Business\Contract;

use Src\Invoice\Model\Business\InvoiceEntity;

interface ICreate
{
    public function create(InvoiceEntity $invoice): void;
}