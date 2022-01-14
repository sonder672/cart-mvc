<?php

namespace Src\Controller\Entity\Product\Service;

use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\Product\Contract\IFindBySubCategory;
use Src\Model\Entity\Product\Exception\ProductBySubCategoryException;

final class ShowBySubCategory implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(IFindBySubCategory $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        $all = $this->repository->findBySubCategory($dto->uuidSubCategory());
        if (count($all) == 0)
        {
            throw new ProductBySubCategoryException('No hay elementos');
        }
        return $all;
    }
}