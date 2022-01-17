<?php

namespace Src\Product\Controller\Service\Crud;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\Product\Model\Business\Contract\Crud\IDelete;

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
