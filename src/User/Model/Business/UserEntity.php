<?php

namespace Src\User\Model\Business;

use Src\Patterns\GenerateUuid;
use Src\User\Model\Business\ValueObject\EmailValueObject;
use Src\User\Model\Business\ValueObject\NameValueObject;
use Src\User\Model\Business\ValueObject\PasswordValueObject;

final class UserEntity
{
    private $uuid;
    private $name;
    private $password;
    private $email;

    public function __construct(
        NameValueObject $name, 
        PasswordValueObject $password,
        EmailValueObject $email
        )
    {
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->uuid = (new GenerateUuid())->uuidv4();
    }

    public function name()
    {
        return $this->name->name();
    }

    public function password()
    {
        return $this->password->password();
    }

    public function email()
    {
        return $this->email->email();
    }

    public function uuid()
    {
        return $this->uuid;
    }
}