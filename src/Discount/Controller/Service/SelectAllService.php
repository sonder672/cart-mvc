<?php

namespace Src\Discount\Controller\Service;

use Src\Discount\Model\Business\Exception\EmptyDiscountException;

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
            throw new EmptyDiscountException('No hay elementos');
        }
        return $all;
    }
}