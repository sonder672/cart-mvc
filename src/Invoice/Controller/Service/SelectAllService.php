<?php

namespace Src\Invoice\Controller\Service;

use Src\Invoice\Model\Business\Exception\EmptyInvoiceException;

final class SelectAllService
{
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $all = $this->repository->all();
        if (count($all) == 0)
        {
            throw new EmptyInvoiceException('No hay elementos');
        }
        return $all;
    }
}