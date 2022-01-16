<?php

namespace Src\Controller\Entity\Product\Service;

use Src\Controller\MediatorPattern\AbstractColleague;
use Src\Controller\MediatorPattern\IMediator;
use Src\Model\Entity\Product\Contract\ICheckProductOutOfStock;
use Src\Model\Entity\Product\Contract\ISubtractStock;

class SubtractStockService extends AbstractColleague
{
    private $repository;

    public function __construct(
        ISubtractStock $repository, 
        IMediator $mediator
        )
    {
        $this->repository = $repository;
        $this->mediator = $mediator;
    }

    public function execute($event, string $message): void
    {
        if ($message == 'NeedSubtractStock')
        {
            $this->__invoke($event);
            echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
        }
    }

    private function __invoke($subtractStockParams)
    {
        $this->repository->update(
            $subtractStockParams['uuid_product'], 
            $subtractStockParams['quantity']
        );
        //Evento para que en caso de que stock sea 0 sold_out pase a ser true.
        $this->mediator->send(
            $subtractStockParams['uuid_product'], 
            'CheckStock', 
            $this
        );
    }
}