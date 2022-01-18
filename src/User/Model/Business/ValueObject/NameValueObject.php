<?php

namespace Src\User\Model\Business\ValueObject;

use Src\User\Model\Business\Exception\InvalidNameException;

final class NameValueObject
{
    private CONST LENGHT = 10;
    private $name;
    
    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function name()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if (strlen($name) < self::LENGHT)
        {
            throw new InvalidNameException('Ingrese nombre y apellido');
        }
        $this->name = $name;
    }
}