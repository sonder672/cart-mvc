<?php

namespace Src\SubCategory\Controller\Service;

use Src\SubCategory\Model\Business\Exception\EmptySubCategoryException;

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
            throw new EmptySubCategoryException('No hay elementos');
        }
        return $all;
    }
}