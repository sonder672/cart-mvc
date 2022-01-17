<?php

namespace Src\SubCategory\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\SubCategory\Model\Business\Contract\IDelete;

final class DeleteService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(IDelete $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        $this->repository->delete($dto->uuid());
    }
}