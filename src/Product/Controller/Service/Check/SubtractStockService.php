<?php

namespace Src\Product\Controller\Service\Check;

use Src\Patterns\MediatorPattern\AbstractColleague;
use Src\Patterns\MediatorPattern\IMediator;
use Src\Product\Model\Business\Contract\Check\ISubtractStock;

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