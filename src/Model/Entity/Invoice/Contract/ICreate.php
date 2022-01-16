<?php

namespace Src\Model\Entity\Invoice\Contract;

use Src\Model\Entity\Invoice\InvoiceEntity;

interface ICreate
{
    public function create(InvoiceEntity $invoice): void;
}