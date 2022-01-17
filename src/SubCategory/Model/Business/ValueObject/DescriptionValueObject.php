<?php

namespace Src\SubCategory\Model\Business\ValueObject;

use Src\SubCategory\Model\Business\Exception\ShortDescriptionException;

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