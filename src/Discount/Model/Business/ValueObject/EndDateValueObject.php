<?php

namespace Src\Discount\Model\Business\ValueObject;

use DateTime;
use Src\Discount\Model\Business\Exception\InvalidDateException;

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