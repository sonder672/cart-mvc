<?php

namespace Src\User\Model\Business\ValueObject;

use Src\User\Model\Business\Exception\InvalidEmailException;

final class EmailValueObject
{
    private $email;
    
    public function __construct(string $email)
    {
        $this->setEmail($email);
    }

    public function email()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new InvalidEmailException('Correo electrónico erróneo');
        }
        $this->email = $email;
    }
}