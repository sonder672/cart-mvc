<?php

namespace Src\Controller\Entity\Discount\Service;

use DateTime;
use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\Discount\Contract\ICreate;
use Src\Model\Entity\Discount\DiscountEntity;
use Src\Model\Entity\Discount\ValueObject\DescriptionValueObject;
use Src\Model\Entity\Discount\ValueObject\EndDateValueObject;
use Src\Model\Entity\Discount\ValueObject\PercentValueObject;

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