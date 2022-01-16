<?php

namespace Src\Controller\Entity\Invoice\Service;

use Src\Controller\MediatorPattern\AbstractColleague;
use Src\Controller\MediatorPattern\IMediator;
use Src\Model\Entity\Invoice\InvoiceEntity;
use Src\Model\Entity\Invoice\ValueObject\UuidValueObject;
use Src\Model\Repository\Invoice\Eloquent\CreateRepository;

class CreateService extends AbstractColleague
{
    private $repository;

    public function __construct(CreateRepository $repository, IMediator $mediator)
    {
        $this->repository = $repository;
        $this->mediator = $mediator;
    }

    public function execute($event, string $message): void
    {
        if ($message == 'NeedCreateInvoice')
        {
            $this->__invoke($event);
            echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
        }
    }

    private function __invoke($invoiceParams)
    {
        $invoice = new InvoiceEntity(
            $invoiceParams['price'],
            new UuidValueObject($invoiceParams['uuid'])
        );

        $this->repository->create($invoice);
    }
}