<?php

namespace Src\User\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\User\Model\Business\Contract\IFind;
use Src\User\Model\Business\Contract\IUpdate;
use Src\User\Model\Business\Exception\InvalidPasswordException;
use Src\User\Model\Business\UserEntity;
use Src\User\Model\Business\ValueObject\EmailValueObject;
use Src\User\Model\Business\ValueObject\NameValueObject;
use Src\User\Model\Business\ValueObject\PasswordValueObject;

final class UpdateService implements IIntermediaryControllerService
{
    private $repository;
    private $findRepository;

    public function __construct(IUpdate $repository, IFind $findRepository)
    {
        $this->repository = $repository;
        $this->findRepository = $findRepository;
    }

    public function __invoke(object $dto)
    {
        $user = $this->findRepository->find($_SESSION['uuid']);
        
        if(!password_verify($dto->password(), $user->password))
        {
            throw new InvalidPasswordException('Contraseña inválida');
        }

        $password = $dto->newPassword();
        if ($password == null)
        {
            $password = $dto->password();
        }

        $user = new UserEntity(
            new NameValueObject($dto->name()),
            new PasswordValueObject($password),
            new EmailValueObject($dto->email())
        );

        $this->repository->update($_SESSION['uuid'], $user);
    }
}