<?php

namespace Src\Product\Controller\Service\Check;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\Product\Model\Business\Contract\Check\IFindBySubCategory;
use Src\Product\Model\Business\Exception\ProductBySubCategoryException;

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