<?php

namespace Src\User\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\User\Model\Business\Contract\IFind;

final class FindService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(IFind $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        return $this->repository->find($dto->uuid());
    }
}