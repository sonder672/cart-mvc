<?php

namespace Src\Model\Entity\Discount\ValueObject;

use Src\Model\Entity\Discount\Exception\PercentInvalidException;

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
