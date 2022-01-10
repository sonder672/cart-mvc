<?php

namespace Src\Model\Entity\SubCategory\ValueObject;

use Src\Model\Entity\SubCategory\Exception\ShortDescriptionException;

final class DescriptionValueObject
{
    private CONST LENGHT = 12;

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
        $this->minimumLenght($description);

        $this->description = $description;
    }

    private function minimumLenght($description)
    {
        if (strlen($description) < self::LENGHT) 
        {
            throw new ShortDescriptionException('Descripción corta');
        }
    }
}