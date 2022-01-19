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
        if ($date < new DateTime('now'))
        {
            throw new InvalidDateException('Fecha a finalizar inválida');
        }
        $this->date = $date;
    }
}