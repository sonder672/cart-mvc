<?php

namespace Src\User\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\User\Model\Business\Contract\ILogin;
use Src\User\Model\Business\Exception\InvalidEmailException;
use Src\User\Model\Business\Exception\InvalidPasswordException;

final class LoginService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(ILogin $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        if(!password_verify(
            $dto->password(), 
            $this->verifyEmail($dto->email())['password'])
            )
        {
            throw new InvalidPasswordException('Contraseña incorrecta');
        }
        
        $_SESSION['uuid'] = $this->verifyEmail($dto->email())['uuid'];
    }

    private function verifyEmail($email)
    {
        $verifyEmail = $this->repository->login($email);

        if(count($verifyEmail) == 0)
        {
            throw new InvalidEmailException('Email incorrecto');
        }

        foreach($verifyEmail as $data)
        {
            $uuid = $data['uuid'];
            $password = $data['password'];
            break;
        }

        return [
            'uuid' => $uuid,
            'password' => $password
        ];
        
    }
}