<?php

namespace Src\Model\Entity\Discount\ValueObject;

use DateTime;
use Src\Model\Entity\Discount\Exception\InvalidDateException;

final class EndDateValueObject
{
    private $date;

    public function __construct($date)
    {
        $this->setEndDate($date);
    }

    public function endDate()
    {
        return $this->date;
    }

    private function setEndDate($date)
    {
        $interval = date_diff($date, new DateTime('now'));
        if ($interval->d < 2)
        {
            throw new InvalidDateException('Fecha a finalizar inválida');
        }
        $this->date = $date;
    }
}