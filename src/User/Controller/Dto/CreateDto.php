<?php

namespace Src\User\Controller\Dto;

final class CreateDto
{
    private $email;
    private $name;
    private $password;

    public function __construct(string $email, string $name, string $password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    public function email()
    {
        return $this->email;
    }

    public function name()
    {
        return $this->name;
    }

    public function password()
    {
        return $this->password;
    }
}