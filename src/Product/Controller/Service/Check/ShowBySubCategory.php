<?php

namespace Src\Product\Controller\Service\Check;

use Src\Product\Model\Business\Contract\Check\IFindBySubCategory;
use Src\Product\Model\Business\Exception\ProductBySubCategoryException;

final class ShowBySubCategory
{
    private $repository;

    public function __construct(IFindBySubCategory $repository)
    {
        $this->repository = $repository;
    }

    public function productSubCategory(string $uuidSubCategory)
    {
        $all = $this->repository->findBySubCategory($uuidSubCategory);
        if (count($all) == 0)
        {
            throw new ProductBySubCategoryException('No hay elementos');
        }
        return $all;
    }
}