<?php

namespace Src\Discount\Model\Business\ValueObject;

use Src\Discount\Model\Business\Exception\ShortDescriptionException;

final class DescriptionValueObject
{
    private CONST LENGHT = 15;
    private $description;

    public function __construct(string $description)
    {
        $this->setDescription($description);
    }

    public function description()
    {
        return $this->description;
    }

    private function setDescription($description)
    {
        if (strlen($description) < self::LENGHT)
        {
            throw new ShortDescriptionException('Descripción corta');
        }
        $this->description = $description;
    }
}