<?php

namespace Src\Shopping\Controller\Dto;

final class SelectByInvoiceDto
{
    private $uuidInvoice;

    public function __construct(string $uuidInvoice)
    {
        $this->uuidInvoice = $uuidInvoice;
    }

    public function uuidInvoice()
    {
        return $this->uuidInvoice;
    }
}