<?php

namespace Src\User\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\User\Model\Business\Contract\ICreate;
use Src\User\Model\Business\UserEntity;
use Src\User\Model\Business\ValueObject\EmailValueObject;
use Src\User\Model\Business\ValueObject\NameValueObject;
use Src\User\Model\Business\ValueObject\PasswordValueObject;

final class CreateService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(ICreate $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        $newUser = new UserEntity(
            new NameValueObject($dto->name()),
            new PasswordValueObject($dto->password()),
            new EmailValueObject($dto->email()) 
        );

        $this->repository->create($newUser);
    }
}