<?php

namespace Src\Discount\Controller\Service;

use DateTime;
use Src\Discount\Model\Business\Contract\ICreate;
use Src\Discount\Model\Business\DiscountEntity;
use Src\Discount\Model\Business\ValueObject\DescriptionValueObject;
use Src\Discount\Model\Business\ValueObject\EndDateValueObject;
use Src\Discount\Model\Business\ValueObject\PercentValueObject;
use Src\Patterns\ProxyPattern\IIntermediaryControllerService;

final class CreateService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(ICreate $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        $newDiscount = new DiscountEntity(
            new PercentValueObject($dto->percent()),
            new EndDateValueObject( new DateTime($dto->endDate()) ),
                new DescriptionValueObject($dto->description())
            );

        $this->repository->create($newDiscount);
    }
}