<?php

namespace Src\Discount\Controller\Service;

use Src\Discount\Model\Business\Contract\IFind;
use Src\Patterns\ProxyPattern\IIntermediaryControllerService;

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