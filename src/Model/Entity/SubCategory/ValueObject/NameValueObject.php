<?php

namespace Src\Model\Entity\SubCategory\ValueObject;

use Src\Model\Entity\SubCategory\Exception\NameWithSpacesException;
use Src\Model\Entity\SubCategory\Exception\ShortNameException;

final class NameValueObject
{
    private CONST LENGHT = 4;

    private $name;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function name()
    {
        return $this->name;
    }

    private function setName($name)
    {
        $this->minimumLenght($name);

        $this->existingSpaces($name);

        $this->name = $name;
    }

    private function minimumLenght($name)
    {
        if (strlen($name) < self::LENGHT) 
        {
            throw new ShortNameException('Nombre corto');
        }
    }

    private function existingSpaces($name)
    {
        if(strpos($name, ' ')) 
        {
            throw new NameWithSpacesException('El nombre no debe contener espacios');
        }
    }  
}