<?php

namespace Src\Shopping\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\Shopping\Model\Business\Exception\EmptyListException;
use Src\Shopping\Model\Repository\Eloquent\SelectByInvoiceRepository;

final class SelectAllService implements IIntermediaryControllerService
{
    private $repository;

    public function __construct(SelectByInvoiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(object $dto)
    {
        $all = $this->repository->findByInvoice($dto->uuidInvoice());
        if (count($all) == 0)
        {
            throw new EmptyListException('No hay elementos');
        }
        return $all;
    }
}