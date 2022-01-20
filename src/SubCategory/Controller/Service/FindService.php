<?php

namespace Src\SubCategory\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\SubCategory\Model\Business\Contract\IFind;
use Src\SubCategory\Model\Business\Exception\EmptySubCategoryException;

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