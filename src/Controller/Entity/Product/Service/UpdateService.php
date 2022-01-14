<?php

namespace Src\Controller\Entity\Product\Service;

use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\Product\Contract\IUpdate;
use Src\Model\Entity\Product\ProductEntity;
use Src\Model\Entity\Product\ValueObject\PriceValueObject;
use Src\Model\Entity\Product\ValueObject\StockValueObject;

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