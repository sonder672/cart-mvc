<?php

namespace Src\User\Controller\Dto;

final class UpdateDto
{
    private $email;
    private $name;
    private $password;
    private $newPassword;

    public function __construct( 
        string $email, 
        string $name, 
        string $password,
        $newPassword)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->newPassword = $newPassword;
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

    public function newPassword()
    {
        return $this->newPassword;
    }
}