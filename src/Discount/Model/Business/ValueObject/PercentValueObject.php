<?php

namespace Src\Discount\Model\Business\ValueObject;

use Src\Discount\Model\Business\Exception\PercentInvalidException;

final class PercentValueObject
{
    private $percent;

    public function __construct(string $percent)
    {
        $this->setPercent($percent);
    }

    public function percent()
    {
        return $this->percent;
    }

    private function setPercent($percent)
    {
        if ($percent > 79 || $percent < 5)
        {
            throw new PercentInvalidException('Porcentaje inválido');
        }
        $this->percent = $percent;
    }
}
