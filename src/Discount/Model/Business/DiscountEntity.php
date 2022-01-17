<?php

namespace Src\Discount\Model\Business;

use DateTime;
use Src\Discount\Model\Business\ValueObject\DescriptionValueObject;
use Src\Discount\Model\Business\ValueObject\EndDateValueObject;
use Src\Discount\Model\Business\ValueObject\PercentValueObject;
use Src\Patterns\GenerateUuid;

final class DiscountEntity
{
    private $uuid;
    private $percent;
    private $startDate;
    private $endDate;
    private $description;

    public function __construct(
        PercentValueObject $percent,
        EndDateValueObject $endDate,
        DescriptionValueObject $description
    )
    {
       $this->percent = $percent;
       $this->endDate = $endDate;
       $this->description = $description;
       $this->uuid = (new GenerateUuid())->uuidv4();
       $this->startDate = new DateTime('now');
    }

    public function uuid()
    {
        return $this->uuid;
    }

    public function percent()
    {
        return $this->percent->percent();
    }

    public function startDate()
    {
        return $this->startDate;
    }

    public function endDate()
    {
        return $this->endDate->endDate();
    }

    public function description()
    {
        return $this->description->description();
    }
}