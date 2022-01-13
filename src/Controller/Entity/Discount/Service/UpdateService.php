<?php

namespace Src\Controller\Entity\Discount\Service;

use DateTime;
use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\Discount\Contract\IUpdate;
use Src\Model\Entity\Discount\DiscountEntity;
use Src\Model\Entity\Discount\ValueObject\DescriptionValueObject;
use Src\Model\Entity\Discount\ValueObject\EndDateValueObject;
use Src\Model\Entity\Discount\ValueObject\PercentValueObject;

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