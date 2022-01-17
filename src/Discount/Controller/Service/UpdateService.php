<?php

namespace Src\Discount\Controller\Service;

use DateTime;
use Src\Discount\Model\Business\Contract\IUpdate;
use Src\Discount\Model\Business\DiscountEntity;
use Src\Discount\Model\Business\ValueObject\DescriptionValueObject;
use Src\Discount\Model\Business\ValueObject\EndDateValueObject;
use Src\Discount\Model\Business\ValueObject\PercentValueObject;
use Src\Patterns\ProxyPattern\IIntermediaryControllerService;

final class UpdateService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(IUpdate $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        $discount = new DiscountEntity(
            new PercentValueObject($dto->percent()),
            new EndDateValueObject(new DateTime($dto->endDate())),
            new DescriptionValueObject($dto->description())
        );

        $this->repository->update($dto->uuid(), $discount);
    }
}