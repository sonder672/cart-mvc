<?php

namespace Src\SubCategory\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\SubCategory\Model\Business\Contract\IUpdate;
use Src\SubCategory\Model\Business\SubCategoryEntity;
use Src\SubCategory\Model\Business\ValueObject\DescriptionValueObject;
use Src\SubCategory\Model\Business\ValueObject\NameValueObject;

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