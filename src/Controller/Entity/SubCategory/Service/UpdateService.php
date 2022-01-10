<?php

namespace Src\Controller\Entity\SubCategory\Service;

use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\SubCategory\Contract\IUpdate;
use Src\Model\Entity\SubCategory\SubCategoryEntity;
use Src\Model\Entity\SubCategory\ValueObject\DescriptionValueObject;
use Src\Model\Entity\SubCategory\ValueObject\NameValueObject;

final class UpdateService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(IUpdate $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        $subCategory = new SubCategoryEntity(
            new NameValueObject($dto->name()),
            new DescriptionValueObject($dto->description()),
            $dto->uuid_discount()
        );

        $this->repository->update($dto->uuid(), $subCategory);
    }
}