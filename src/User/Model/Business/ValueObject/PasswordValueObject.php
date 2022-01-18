<?php

namespace Src\User\Model\Business\ValueObject;

use Src\User\Model\Business\Exception\InvalidPasswordException;

final class PasswordValueObject
{
    private CONST LENGHT = 8;
    private $password;
    
    public function __construct(string $password)
    {
        $this->setPassword($password);
    }

    public function password()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (strlen($password) < self::LENGHT)
        {
            throw new InvalidPasswordException('Ingrese una contraseña más larga');
        }
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}