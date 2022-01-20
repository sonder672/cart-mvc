<?php

namespace Src\Product\Controller\Service\Crud;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\Product\Model\Business\Contract\Crud\IFind;

final class FindService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(IFind $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        return $this->repository->findOrFail($dto->uuid());
    }
}