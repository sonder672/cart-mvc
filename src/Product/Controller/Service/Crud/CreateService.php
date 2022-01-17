<?php

namespace Src\Product\Controller\Service\Crud;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\Product\Model\Business\Contract\Crud\ICreate;
use Src\Product\Model\Business\ProductEntity;
use Src\Product\Model\Business\ValueObject\PriceValueObject;
use Src\Product\Model\Business\ValueObject\StockValueObject;

final class CreateService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(ICreate $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        $newProduct = new ProductEntity(
            new StockValueObject($dto->stock()),
            new PriceValueObject($dto->price()),
            $dto->uuidSubCategory(),
            $dto->name()
        );

        $this->repository->create($newProduct);
    }
}