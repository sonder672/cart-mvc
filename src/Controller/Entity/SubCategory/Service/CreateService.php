<?php

namespace Src\Controller\Entity\SubCategory\Service;

use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\SubCategory\Contract\ICreate;
use Src\Model\Entity\SubCategory\SubCategoryEntity;
use Src\Model\Entity\SubCategory\ValueObject\DescriptionValueObject;
use Src\Model\Entity\SubCategory\ValueObject\NameValueObject;

final class CreateService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(ICreate $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        $newSubCategory = new SubCategoryEntity(
            new NameValueObject($dto->name()),
            new DescriptionValueObject($dto->description()),
            $dto->uuid_discount()
        );

        $this->repository->create($newSubCategory);
    }
}