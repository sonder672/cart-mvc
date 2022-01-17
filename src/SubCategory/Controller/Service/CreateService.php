<?php

namespace Src\SubCategory\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\SubCategory\Model\Business\Contract\ICreate;
use Src\SubCategory\Model\Business\SubCategoryEntity;
use Src\SubCategory\Model\Business\ValueObject\DescriptionValueObject;
use Src\SubCategory\Model\Business\ValueObject\NameValueObject;

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