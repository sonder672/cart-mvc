<?php

namespace Src\Product\Controller\Service\Crud;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\Product\Model\Business\Contract\Crud\IUpdate;
use Src\Product\Model\Business\ProductEntity;
use Src\Product\Model\Business\ValueObject\PriceValueObject;
use Src\Product\Model\Business\ValueObject\StockValueObject;

final class UpdateService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(IUpdate $repository)
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

        $this->repository->update($dto->uuid(), $newProduct);
    }
}