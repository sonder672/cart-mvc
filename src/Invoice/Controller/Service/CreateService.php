<?php

namespace Src\Invoice\Controller\Service;

use Src\Invoice\Model\Business\InvoiceEntity;
use Src\Invoice\Model\Business\ValueObject\UuidValueObject;
use Src\Invoice\Model\Repository\Eloquent\CreateRepository;
use Src\Patterns\MediatorPattern\AbstractColleague;
use Src\Patterns\MediatorPattern\IMediator;

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