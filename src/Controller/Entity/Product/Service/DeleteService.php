<?php

namespace Src\Controller\Entity\Product\Service;

use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\Product\Contract\IDelete;

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
