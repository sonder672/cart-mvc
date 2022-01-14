<?php

namespace Src\Controller\Entity\Product\Service;

use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\Product\Contract\ICreate;
use Src\Model\Entity\Product\ProductEntity;
use Src\Model\Entity\Product\ValueObject\PriceValueObject;
use Src\Model\Entity\Product\ValueObject\StockValueObject;

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